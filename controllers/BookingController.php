<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BookingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    private function storeBookingData($product_id)
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('Booking');
            if ($data) {
                // Map legacy fields if necessary, or just store raw
                // Legacy allows distinct Date/Time/Count
                $sessionData = [
                    'product' => $product_id, // Force product ID based on action
                    'name' => $data['name'] ?? '',
                    'email' => $data['email'] ?? '',
                    'phone' => $data['phone'] ?? '',
                    'date' => $data['date'] ?? '',
                    'adults' => $data['no_of_units'] ?? 1, // Legacy often used 'no_of_units' as total
                    // Water world specific might have 'no_of_adults' etc in legacy? 
                    // Let's just save the whole blob to be safe
                    'legacy_data' => $data
                ];
                Yii::$app->session->set('pending_booking', $sessionData);
            }
        }
    }

    public function actionAddTickets()
    {
         $this->storeBookingData(4);
         return $this->redirect(['client/book', 'product' => 4]);
    }

    public function actionWaterWorld()
    {
        $this->storeBookingData(8);
        return $this->redirect(['client/book', 'product' => 8]);
    }

    public function actionAddparkCombo()
    {
         $this->storeBookingData(7);
         return $this->redirect(['client/book', 'product' => 7]);
    }

    public function actionFullPackage()
    {
         $this->storeBookingData(7);
         return $this->redirect(['client/book', 'product' => 7]); 
    }
    
    public function actionPicnicspotBooking()
    {
         $this->storeBookingData(3);
         return $this->redirect(['client/book', 'product' => 3]); 
    }

    public function actionFivedBooking()
    {
        $this->storeBookingData(9);
        return $this->redirect(['client/book', 'product' => 9]); 
    }

    public function actionFailure()
    {
        return $this->render('failure');
    }
}
