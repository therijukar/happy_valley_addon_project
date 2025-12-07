<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Feedback;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class FeedbackController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        $lists = Feedback::find()->where(['soft_delete' => '0'])->orderBy(['id'=> SORT_DESC])->all();
        
        return $this->render('list', ['lists' => $lists]);
        
    }

    public function actionDeleteFeedback($id)
    {       
        $model = Feedback::findOne($id);
        $model->soft_delete = 1;
        
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->baseUrl . '/admin/feedback/list');
        }
    }

    public function actionBulkdelete()
    {
        $data = Yii::$app->request->post();
         
        if(count($data['checked_id'])>0)
        {
            $ret = $this->projectUserBulkDelete('app\models\Feedback', $data['checked_id']);
            if($ret=='success')
            {
                
                Yii::$app->response->redirect(['admin/feedback/list']);
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
            Yii::$app->response->redirect(['admin/enquiry/list']);
            $_SESSION['bulkMessage'] = 'Please Select At Least 1 Enquiry';
        }
    }

}
