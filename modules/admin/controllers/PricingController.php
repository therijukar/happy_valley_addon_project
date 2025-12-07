<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Pricing;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class PricingController extends Controller
{
    public function actionCreate()
    {
        $this->layout = 'admin';
        $model = new Pricing();

        if ($model->load(Yii::$app->request->post())) {
            // Auto-generate product_code
            $maxCode = Pricing::find()->max('product_code');
            $model->product_code = $maxCode ? $maxCode + 1 : 1;
            $model->updated_at = date('Y-m-d H:i:s');
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Ticket created successfully');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to create ticket: ' . json_encode($model->getErrors()));
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $this->layout = 'admin';
        $query = Pricing::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
    	$this->layout = 'admin';
        $model = Pricing::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException("Pricing not found");
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Price updated successfully');
                return $this->redirect(['index']);
            } else {
                 Yii::$app->session->setFlash('error', 'Failed to update ticket: ' . json_encode($model->getErrors()));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->layout = 'admin';
        $model = Pricing::findOne($id);

        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Ticket deleted successfully');
        } else {
            Yii::$app->session->setFlash('error', 'Ticket not found');
        }

        return $this->redirect(['index']);
    }
}
