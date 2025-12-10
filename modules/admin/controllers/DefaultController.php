<?php

namespace app\modules\admin\controllers;

use app\models\Booking;
use app\models\Enquiry;
use Yii;
use yii\web\Controller;
use app\models\Administrator;
use yii\web\Session;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

	


    public function actionIndex()
    {
        return $this->actionDashboard();
    }

    public function actionDashboard()
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';

        // Common conditions
        $query = Booking::find()->where(['is_active' => '1', 'soft_delete' => '0']);

        // 1. Restaurant (Product = 1)
        $restaurant = (clone $query)->andWhere(['product' => '1'])->count();

        // 2. Banquet (Product = 2)
        $banquet = (clone $query)->andWhere(['product' => '2'])->count();

        // 3. Picnic Spots (Product = 3)
        $picnic_spots = (clone $query)->andWhere(['product' => '3'])->count();

        // 4. Tickets (Count by Ticket No existence as requested)
        $ticketQuery = (clone $query)->andWhere(['!=', 'ticket_no', '']);
        $ticket = $ticketQuery->count();

        // --- NEW ANALYTICS ---

        // --- NEW ANALYTICS WITH FILTERS & HISTORY ---
        $request = Yii::$app->request;
        $period = $request->get('period', 'year'); // week, month, year
        $steps = (int)$request->get('steps', 0); // 0 = current, 1 = prev, -1 = next

        // Base Ticket Query for Analytics
        $analyticsQuery = (clone $ticketQuery);
        
        $chartLabels = [];
        $chartValues = [];
        $periodRevenue = 0;
        $periodTitle = "";
        
        // Navigation Helpers
        $prevStep = $steps + 1;
        $nextStep = $steps - 1;

        if ($period == 'week') {
            // Logic: Steps * 7 days ago.
            // "Last 7 Days" (0) -> Today back to Today-6
            // Prev (1) -> Today-7 back to Today-13
            
            $offsetDays = $steps * 7;
            $endDateObj = new \DateTime("-$offsetDays days");
            $startDateObj = clone $endDateObj;
            $startDateObj->modify('-6 days'); // 7 day window
            
            $startDateStr = $startDateObj->format('Y-m-d');
            $endDateStr = $endDateObj->format('Y-m-d');
            
            $periodTitle = $startDateObj->format('M d') . ' - ' . $endDateObj->format('M d');
            
            // Filter Query
            $analyticsQuery->andWhere(['between', 'created_date', $startDateStr . ' 00:00:00', $endDateStr . ' 23:59:59']);
            
            // Group by Date for Chart
            $stats = (clone $analyticsQuery)
                ->select(['COUNT(*) as cnt', 'DATE(created_date) as date', 'SUM(amount) as revenue'])
                ->groupBy(new \yii\db\Expression('DATE(created_date)'))
                ->asArray()
                ->all();
                
            // Generate Labels for valid range (Start to End)
            $curr = clone $startDateObj;
            while($curr <= $endDateObj) {
                $d = $curr->format('Y-m-d');
                $chartLabels[] = $curr->format('D d');
                
                $found = false;
                foreach($stats as $s) {
                    if($s['date'] == $d) {
                        $chartValues[] = (int)$s['cnt'];
                        $periodRevenue += (float)$s['revenue'];
                        $found = true; break;
                    }
                }
                if(!$found) $chartValues[] = 0;
                
                $curr->modify('+1 day');
            }

        } elseif ($period == 'month') {
            // Month Logic
            // Step 0 = This Month
            // Step 1 = Last Month
            $targetDate = new \DateTime("first day of -$steps month");
            $targetMonth = $targetDate->format('m');
            $targetYear = $targetDate->format('Y');
            $daysInMonth = $targetDate->format('t');
            
            $periodTitle = $targetDate->format('F Y');
            
            $analyticsQuery->andWhere(['MONTH(created_date)' => $targetMonth, 'YEAR(created_date)' => $targetYear]);
            
            $stats = (clone $analyticsQuery)
                ->select(['COUNT(*) as cnt', 'DAY(created_date) as day', 'SUM(amount) as revenue'])
                ->groupBy(new \yii\db\Expression('DAY(created_date)'))
                ->asArray()
                ->all();
            
            $periodRevenue = (clone $analyticsQuery)->sum('amount') ?? 0;

            // Fill 1 to Total Days
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $chartLabels[] = (string)$i;
                $found = false;
                foreach($stats as $s) {
                    if($s['day'] == $i) {
                        $chartValues[] = (int)$s['cnt'];
                        $found = true; break;
                    }
                }
                if(!$found) $chartValues[] = 0;
            }

        } else {
            // YEAR (Default)
            // Step 0 = This Year
            $targetDate = new \DateTime("-$steps year");
            $targetYear = $targetDate->format('Y');
            
            $periodTitle = $targetYear;
            
            $analyticsQuery->andWhere(['YEAR(created_date)' => $targetYear]);
            
            $stats = (clone $analyticsQuery)
                ->select(['COUNT(*) as cnt', 'MONTH(created_date) as month', 'SUM(amount) as revenue'])
                ->groupBy(new \yii\db\Expression('MONTH(created_date)'))
                ->asArray()
                ->all();
                
            $periodRevenue = (clone $analyticsQuery)->sum('amount') ?? 0;

            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            foreach($months as $idx => $name) {
                $mNum = $idx + 1;
                $chartLabels[] = $name;
                $found = false;
                foreach($stats as $s) {
                    if($s['month'] == $mNum) {
                        $chartValues[] = (int)$s['cnt'];
                        $found = true; break;
                    }
                }
                if(!$found) $chartValues[] = 0;
            }
        }
        
        // Calculate Period Totals (Dynamic based on selection)
        // 1. Total Tickets for Period
        $periodCount = (clone $analyticsQuery)->count();
        
        // 2. Averages
        $avgLabel = "Daily Avg";
        $avgCount = 0;
        
        if($period == 'week') {
            $avgCount = $periodCount / 7;
        } elseif($period == 'month') {
            // Use target month days
            $days = isset($daysInMonth) ? $daysInMonth : 30; 
            $avgCount = $periodCount / $days;
        } else {
            // Year
            $avgLabel = "Monthly Avg";
            $avgCount = $periodCount / 12;
        }
        
        // Static Totals (Optional context)
        $totalRevenueAllTime = (clone $ticketQuery)->sum('amount') ?? 0;

        return $this->render('dashboard', [
            'ticket' => $ticket, 
            'restaurant'=> $restaurant, 
            'banquet' => $banquet, 
            'picnic_spots' => $picnic_spots,
            // Stats
            'totalRevenue' => $totalRevenueAllTime,
            // Period Data (Filtered)
            'period' => $period,
            'steps' => $steps,
            'prevStep' => $prevStep,
            'nextStep' => $nextStep,
            'periodTitle' => $periodTitle,
            'periodRevenue' => $periodRevenue,
            'periodCount' => $periodCount,
            'avgSales' => round($avgCount, 1),
            'avgLabel' => $avgLabel,
            'chartLabels' => json_encode($chartLabels),
            'chartValues' => json_encode($chartValues)
        ]);
    }
}
