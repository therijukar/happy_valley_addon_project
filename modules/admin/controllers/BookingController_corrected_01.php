<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Booking;
use app\models\Payments;
use app\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\Util\GlobalUtilities;
use yii\web\Session;
/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    use GlobalUtilities;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Booking model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Booking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionList()
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        
        // Check if this is an AJAX request for DataTables
        if (Yii::$app->request->isAjax && Yii::$app->request->get('draw')) {
            return $this->actionGetBookingData();
        }
        
        // For initial page load, just render the view without data
        return $this->render('bookinglist');
        
    }
    
    
       public function actionVerifyOtp()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        $otp = Yii::$app->request->post('otp');
        $bookingId = Yii::$app->request->post('bookingId');
        $booking = Booking::findOne($bookingId);
    
        if ($booking && $booking->otp == $otp) { // Simulated OTP verification, replace with your actual logic
            // Update the booking status to "verified" in the database
            $booking->status = 1;
            $booking->visited = 1;
            $booking->otp = null;
            $booking->save();
            return ['success' => true, 'message' => 'OTP verified successfully.'];
        } elseif (!$booking) {
            return ['success' => false, 'message' => 'Error: Booking not found.'];
        } else {
            return ['success' => false, 'message' => 'Error: Invalid OTP.'];
        }
    }

 public function actionResendOtp()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        $bookingId = Yii::$app->request->post('bookingId');
        $booking = Booking::findOne($bookingId);
    
        // Update the booking status to "verified" in the database
        if($booking)
        {
            
        $otp =  rand(1111, 9999);
        
        $booking->otp = $otp;
        $booking->save(); 
         $date = date('d/m/Y', strtotime($booking->date));
        $message = "$ticket|$date|$booking->no_of_units|$otp|";
        $phone = $booking->phone;
        if (strpos($phone, '+91') !== false) {
            // Remove '+91' prefix
            $phone = substr($phone, 3);
        } elseif (strpos($phone, '0') === 0) {
            // Remove '0' prefix
            $phone = substr($phone, 1);
        }
       
        $send =$this->sendSms($phone,$message);
        }
       
        return ['success' => true, 'message' => 'OTP Sent successfully.'];
        
    }
    
    
    
    
     public function sendSMS($numbers, $variables_values) {
        $apiKey = 'RSyJt9aO7pfXx05sUqwDW4IiYQ3bECGNVKHLTuvncA6zgeZ1kmpTbhaQs8Hy2ZLOBMDFlJY4R96SoiIq'; // Replace 'Your-API-Key' with your actual Fast2SMS API key
        $senderId = 'RYLTHR'; // Your sender ID
        $route = 'dlt'; // Route for sending the message (p for promotional, t for transactional)
        $postData = array(
            'sender_id' => $senderId,
            'message' => '167334',
            'language' => 'english',
            'route' => $route,
            'numbers' => $numbers,
            'variables_values' => $variables_values,
        );
    
        $url = 'https://www.fast2sms.com/dev/bulkV2';
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'authorization: ' . $apiKey,
            'content-type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
  
    public function actionDeleteBooking($id)
    {       
        $model = Booking::findOne($id);
        $model->soft_delete = 1;
        
        if ($model->save()) {
            
             $session = new Session();
             $session->open();
             $session['Update'] = 'Update';
            return $this->redirect(Yii::$app->request->baseUrl . '/admin/booking/list');
        }
    }
 
    
    
   
    public function actionAdd()
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        
        $model = new Booking();        
        if ($model->load(Yii::$app->request->post())) {
           $model->type = "1";
            $model->save();             
            return $this->redirect(Yii::$app->request->baseUrl.'/admin/booking/list');
        }
        else
        {
            return $this->render('addbooking', ['model' => $model]);
        }
    }
  
    public function actionBulkdelete()
    {
        $data = Yii::$app->request->post();
         
        if(count($data['checked_id'])>0)
        {
            $ret = $this->projectUserBulkDelete('app\models\Booking', $data['checked_id']);
            if($ret=='success')
            {
                
                Yii::$app->response->redirect(['admin/booking/list']);
            }
            else
            {
                echo "<h1>Forbidden (#500)</h1> <div class='alert alert-danger'> ".$ret." </div> <p> The above error occurred while the Web server was processing your request. </p>
                    <p>
                        Please contact us if you think this is a server error. Thank you.
                    </p>";
            }
        }
        else
        {
            Yii::$app->response->redirect(['admin/booking/list']);
            $_SESSION['bulkMessage'] = 'Please Select At Least 1 Booking';
        }
    }
 
    public function actionEditBooking($id)
    {
        $msg = '';
        $errors = array();
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        
        $model = Booking::find()->where(['id' => $id])->one();
        
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                
                 $session = new Session();
                 $session->open();
                 $session['Update'] = 'Update';
                return $this->redirect(Yii::$app->request->baseUrl . '/admin/booking/list');
            } 
        } else {
            return $this->render('editbooking', ['model'=> $model]);
        }
    }

    public function actionStatus()
    {           
        if(isset($_POST['success']) && $_POST['success']=='true')
        {                       
            $booking = Booking::findOne($_POST['id']);
            $booking->visited = $_POST['visited'];
            $booking->save();
        }        
    }

    public function actionBookingDetail(){
        $id = $_POST['id'];
        $booking = Booking::find()->where(['id' => $id])->one();
        $payment = Payments::find()->where(['booking_id' => $id])->one();
        $arr = array();
        
        $arr['name'] = isset($booking->name) ? $booking->name: 'N/A';
        $arr['phone'] = isset($booking->phone) ? $booking->phone: 'N/A';
        //$arr['email'] = isset($booking->email) ? $booking->email: 'N/A';
        $arr['product'] = 'Entry Ticket';
        $arr['units'] = isset($booking->no_of_units) ? $booking->no_of_units: 'N/A';
        $arr['amount'] = isset($booking->amount) ? $booking->amount: 'N/A';
        $arr['date'] = isset($booking->date) ? date('d-m-Y', strtotime($booking->date)): 'N/A';
        $arr['txnid'] = isset($payment->txn_id) ? $payment->txn_id: 'N/A';
        $arr['payu_id'] = isset($payment->payu_money_id) ? $payment->payu_money_id: 'N/A';
        echo json_encode($arr);
    }
    
    /**
     * Get booking data for DataTables server-side processing
     */
    public function actionGetBookingData()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $request = Yii::$app->request;
        $draw = $request->get('draw', 1);
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $searchValue = $request->get('search', ['value' => ''])['value'];
        $orderColumn = $request->get('order', [['column' => 0, 'dir' => 'desc']])[0]['column'];
        $orderDir = $request->get('order', [['column' => 0, 'dir' => 'desc']])[0]['dir'];
        
        // Base query
        $query = Booking::find()
            ->where(['soft_delete' => '0'])
            ->andWhere(['!=', 'ticket_no', '']);
        
        // Search functionality
        if (!empty($searchValue)) {
            $query->andWhere([
                'or',
                ['like', 'name', $searchValue],
                ['like', 'phone', $searchValue],
                ['like', 'ticket_no', $searchValue],
                ['like', 'email', $searchValue]
            ]);
        }
        
        // Total records count
        $totalRecords = $query->count();
        
        // Ordering
        $columns = ['id', 'name', 'phone', 'type', 'product', 'belowtenyears', 'abovetenyears', 'no_of_units', 'date', 'ticket_no'];
        if (isset($columns[$orderColumn])) {
            $query->orderBy([$columns[$orderColumn] => $orderDir === 'asc' ? SORT_ASC : SORT_DESC]);
        }
        
        // Pagination
        $query->limit($length)->offset($start);
        
        // Get data
        $bookings = $query->all();
        
        // Prepare response data
        $data = [];
        foreach ($bookings as $booking) {
            // Get booking category
            $bookingCategory = $this->getBookingCategory($booking->product);
            
            // Get payment info
            $payment = Payments::find()->where(['booking_id' => $booking->id])->one();
            $transactionId = $payment ? $payment->txn_id : 'N/A';
            
            $data[] = [
                $booking->id,
                $booking->name,
                $booking->phone,
                $booking->type == '1' ? 'Web' : 'App',
                $bookingCategory,
                $booking->belowtenyears,
                $booking->abovetenyears,
                $booking->no_of_units,
                isset($booking->date) ? date('d-m-Y', strtotime($booking->date)) : '',
                $booking->ticket_no,
                $transactionId,
                $this->getStatusButton($booking),
                $this->getActionButton($booking),
                $this->getVerifyButton($booking),
                $this->getResendButton($booking)
            ];
        }
        
        return [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ];
    }
    
    /**
     * Get booking category name
     */
    private function getBookingCategory($product)
    {
        $categories = [
            1 => "Restaurant Booking",
            2 => "Banquet Booking", 
            3 => "Picnic Spot Booking",
            4 => "Entry Ticket",
            5 => "Water Park + Park Ride Booking",
            6 => "Dry Park Combo",
            7 => "Full Package",
            8 => "Water World",
            9 => "Water Dry Combo"
        ];
        
        return isset($categories[$product]) ? $categories[$product] : 'Unknown';
    }
    
    /**
     * Get status button HTML
     */
    private function getStatusButton($booking)
    {
        if ($booking->visited == '0') {
            return '<button class="btn btn-primary chng" id="' . $booking->id . '" data-visit="1">Not Visited</button>';
        } else {
            return '<button class="btn btn-danger" id="' . $booking->id . '" data-visit="0">Visited</button>';
        }
    }
    
    /**
     * Get action button HTML
     */
    private function getActionButton($booking)
    {
        return '<a href="javascript:void(0)" class="btn btn-info btn-circle" title="Detail" onclick="getDetail(' . $booking->id . ')"><i class="fas fa-info-circle"></i></a>';
    }
    
    /**
     * Get verify button HTML
     */
    private function getVerifyButton($booking)
    {
        if (($booking->status == 0) && ($booking->otp != null)) {
            return '<button type="button" class="btn btn-primary" onclick="setBookingId(' . $booking->id . ')" data-toggle="modal" data-target="#otpModal">Verify</button>';
        } else {
            return '<p>Booking Verified</p>';
        }
    }
    
    /**
     * Get resend button HTML
     */
    private function getResendButton($booking)
    {
        if ($booking->status == 0) {
            return '<button type="button" class="btn btn-primary" onclick="resendOtp(' . $booking->id . ')">Send</button>';
        }
        return '';
    }
}
