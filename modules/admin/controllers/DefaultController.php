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
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        $ticket =Booking::find()->where(['is_active'=>'1','soft_delete'=>'0'])->andWhere(['!=','ticket_no',''])->all();
        $ticketNum = count($ticket);
        $enquiries =Enquiry::find()->where(['soft_delete'=>'0'])->all();
        $restaurant = $banquet = $picnic_spots = 0;
        foreach($enquiries as $enquiry){
            switch($enquiry['product']){
                case '1' : $restaurant += 1;break;
                case '2' : $banquet += 1;break;
                case '3' : $picnic_spots += 1;break;
                default : break;
            }
        }
        

        return $this->render('dashboard', ['ticket' => $ticketNum, 'restaurant'=> $restaurant, 'banquet' => $banquet, 'picnic_spots' => $picnic_spots]);
    }

    public function actionDashboard()
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';

        return $this->render('dashboard');
    }
}
