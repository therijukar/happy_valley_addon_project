<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Enquiry;
use app\models\EnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnquiryController implements the CRUD actions for Enquiry model.
 */
class EnquiryController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
     * Lists all Enquiry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnquirySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Enquiry model.
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
     * Creates a new Enquiry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Enquiry();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Enquiry model.
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
     * Deletes an existing Enquiry model.
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
     * Finds the Enquiry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Enquiry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Enquiry::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionList($pid)
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        $product  = array('1' => 'Restaurant', '2' => 'Banquet', '3' => 'Picnic Spots' );
        $lists = Enquiry::find()->where(['soft_delete' => '0','product'=>$pid])->orderBy(['id'=> SORT_DESC])->all();
        
        return $this->render('list', ['lists' => $lists,'product' => $product[$pid]]);
        
    }

    public function actionEnquiryDetail(){
        $id = $_POST['id'];
        $enquiry = Enquiry::find()->where(['id' => $id])->one();
        $product_arr  = array('1' => 'Restaurant', '2' => 'Banquet', '3' => 'Picnic-Spots' );
        $arr = array();
        $arr['name'] = isset($enquiry->name) ? $enquiry->name: 'N/A';
        $arr['phone'] = isset($enquiry->phone) ? $enquiry->phone: 'N/A';
        $arr['email'] = isset($enquiry->email) ? $enquiry->email: 'N/A';
        $arr['time'] = isset($enquiry->time) ? $enquiry->time: 'N/A';
        $product = isset($enquiry->product) ? $product_arr[$enquiry->product]: 'N/A';
        $arr['product'] = $product;
        $arr['people'] = isset($enquiry->no_of_people) ? $enquiry->no_of_people: 'N/A';
        $arr['spots'] = isset($enquiry->no_of_spots) ? $enquiry->no_of_spots: 'N/A';
        $arr['from_date'] = isset($enquiry->from_date) ? date('d-m-Y', strtotime($enquiry->from_date)): 'N/A';
        $arr['to_date'] = isset($enquiry->to_date) ? date('d-m-Y', strtotime($enquiry->to_date)): 'N/A';
        echo json_encode($arr);
    }

    public function actionDeleteEnquiry($id)
    {       
        $model = Enquiry::findOne($id);
        $model->soft_delete = 1;
        
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->baseUrl . '/admin/enquiry/list');
        }
    }

    public function actionBulkdelete()
    {
        $data = Yii::$app->request->post();
         
        if(count($data['checked_id'])>0)
        {
            $ret = $this->projectUserBulkDelete('app\models\Enquiry', $data['checked_id']);
            if($ret=='success')
            {
                
                Yii::$app->response->redirect(['admin/enquiry/list']);
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
