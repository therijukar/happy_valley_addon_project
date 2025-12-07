<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Holiday;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class HolidayController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'admin';
        $holidayDates = Holiday::find( );
        $model = new Holiday();
        $dataProvider = new ActiveDataProvider([
            'query' => $holidayDates,
            'pagination' => [
                'pageSize' => 10, // Adjust as needed
            ],
            'sort' => [
                'defaultOrder' => ['date' => SORT_DESC],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionCreate()
{
    $model = new Holiday();

    // Load the data from the AJAX request
    if ($model->load(Yii::$app->request->post())) {
        // Validate the model
        if ($model->validate()) {
            $date = Yii::$app->request->post('date'); // Retrieve the date from POST data
            $model->date = date('Y-m-d', strtotime($model->date)); // Fix typo here
            // Save the model
            if ($model->save()) {
                // Return a success response
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => true];
            } else {
                // Return an error response if saving fails
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'errors' => $model->errors];
            }
        } else {
            // Return validation errors if the model is invalid
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => false];
        }
    }
}



public function actionDelete()
{

        $id = Yii::$app->request->get('id'); // Get the ID of the holiday to delete from the POST data

        // Attempt to find the holiday record by ID
        $model = Holiday::findOne($id);

        // If the holiday record is found, attempt to delete it
        if ($model !== null) {
            try {
                if ($model->delete()) {
                    // Set a success flash message
                    Yii::$app->session->setFlash('success', 'Holiday deleted successfully.');

                    // Redirect to the index page
                    return $this->redirect(['index']);
                } else {
                    // Set an error flash message if deletion fails
                    Yii::$app->session->setFlash('error', 'Failed to delete the holiday.');
                    return $this->redirect(['index']);

                }
            } catch (\Throwable $e) {
                // Return an error response if an exception occurs during deletion
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'error' => $e->getMessage()];
            }
        } else {
            // Return an error response if the holiday record is not found
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => false, 'error' => 'Holiday not found.'];
        }
   
}

    
   

}