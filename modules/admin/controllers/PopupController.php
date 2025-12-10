<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Popup;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class PopupController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Popup::find()->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Popup();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            
            $image = UploadedFile::getInstance($model, 'image_url');
            if ($image) {
                $uniqueName = uniqid() . '.' . $image->extension;
                $uploadPath = Yii::getAlias('@webroot/uploads/popup/');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $image->saveAs($uploadPath . $uniqueName);
                $model->image_url = 'uploads/popup/' . $uniqueName;
            }

            // Ensure only one popup is active if this one is active
            if ($model->status == 1) {
                Popup::updateAll(['status' => 0], 'id > 0');
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Popup created successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Popup::findOne($id);
        if ($model) {
            // Optional: delete file from server
            if (file_exists(Yii::getAlias('@webroot/') . $model->image_url)) {
                @unlink(Yii::getAlias('@webroot/') . $model->image_url);
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Popup deleted.');
        }
        return $this->redirect(['index']);
    }

    public function actionToggleStatus($id)
    {
        $model = Popup::findOne($id);
        if ($model) {
            if ($model->status == 0) {
                // Deactivate all others first (single popup policy)
                Popup::updateAll(['status' => 0]);
                $model->status = 1;
            } else {
                $model->status = 0;
            }
            $model->save(false);
        }
        return $this->redirect(['index']);
    }
}
