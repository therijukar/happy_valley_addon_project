<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Booking;
use app\models\Payments;
use app\models\BookingSearch;
use app\models\Pricing;
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

        if ($booking && $booking->otp == $otp) {
            // Update the booking status to "verified" and "visited"
            if($booking->status == 0) $booking->status = 1; // Confirm if pending
            $booking->visited = 1; // Mark as Entered
            $booking->otp = null; // Clear OTP
            $booking->save(false);
            return ['success' => true, 'message' => 'OTP verified successfully. Entry Approved.'];
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
    
        if (!$booking) {
            return ['success' => false, 'message' => 'Booking not found.'];
        }
        
        try {
            $otp = rand(1111, 9999);
            $booking->otp = $otp;
            
            if (!$booking->save()) {
                return ['success' => false, 'message' => 'Failed to save OTP.'];
            }
            
            $date = date('d/m/Y', strtotime($booking->date));
            $message = "$booking->ticket_no|$date|$booking->no_of_units|$otp|";
            $phone = $booking->phone;
            
            if (strpos($phone, '+91') !== false) {
                $phone = substr($phone, 3);
            } elseif (strpos($phone, '0') === 0) {
                $phone = substr($phone, 1);
            }
           
            $smsResponse = $this->sendSMS($phone, $message);
            
            Yii::info('OTP resent successfully for booking ID: ' . $bookingId . '. SMS Response: ' . $smsResponse, 'booking');
            
            return ['success' => true, 'message' => 'OTP sent successfully.'];
            
        } catch (\Exception $e) {
            Yii::error('Failed to resend OTP for booking ID: ' . $bookingId . '. Error: ' . $e->getMessage(), 'booking');
            return ['success' => false, 'message' => 'Failed to resend OTP. Please try again later or contact support.'];
        }
    }
    
    
    
    
     public function sendSMS($numbers, $variables_values) {
        try {
            // First try with cURL
            return $this->sendSMSWithCurl($numbers, $variables_values);
        } catch (\Exception $e) {
            Yii::warning('cURL SMS failed: ' . $e->getMessage() . '. Trying fallback method.', 'sms');
            
            try {
                // Fallback to file_get_contents
                return $this->sendSMSWithFileGetContents($numbers, $variables_values);
            } catch (\Exception $fallbackError) {
                Yii::error('Both SMS methods failed. cURL error: ' . $e->getMessage() . '. Fallback error: ' . $fallbackError->getMessage(), 'sms');
                throw new \Exception('SMS sending failed with both methods. Primary error: ' . $e->getMessage() . '. Fallback error: ' . $fallbackError->getMessage());
            }
        }
    }
    
    private function sendSMSWithCurl($numbers, $variables_values) {
        // Validate input parameters
        if (empty($numbers)) {
            throw new \Exception('Phone number cannot be empty');
        }
        if (empty($variables_values)) {
            throw new \Exception('Message content cannot be empty');
        }
        
        // Validate phone number format
        $numbers = trim($numbers);
        if (!preg_match('/^[0-9]{10,12}$/', $numbers)) {
            throw new \Exception('Invalid phone number format. Must be 10-12 digits.');
        }
        
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
        
        // Check if cURL is available
        if (!function_exists('curl_init')) {
            throw new \Exception('cURL extension is not installed or enabled');
        }
        
        // Check SSL support
        if (!extension_loaded('openssl')) {
            Yii::warning('OpenSSL extension is not loaded. SSL verification disabled.', 'sms');
        }
        
        $ch = curl_init();
        
        if (!$ch) {
            throw new \Exception('Failed to initialize cURL');
        }
        
        // Enable verbose output for debugging (will be logged to error_log)
        $verbose = fopen('php://temp', 'w+');
        
        // Set cURL options
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                'authorization: ' . $apiKey,
                'content-type: application/json'
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification for testing
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3,
            CURLOPT_USERAGENT => 'HappyValleyPark/1.0',
            CURLOPT_VERBOSE => true,
            CURLOPT_STDERR => $verbose,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4, // Force IPv4
            CURLOPT_ENCODING => '', // Accept all encodings
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1 // Use HTTP 1.1
        ));
        
        $response = curl_exec($ch);
        
        // Get verbose output for debugging
        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        fclose($verbose);
        
        if ($response === false) {
            $error = curl_error($ch);
            $errno = curl_errno($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            
            Yii::error('cURL failed: ' . $error . ' (errno: ' . $errno . '). Info: ' . json_encode($info), 'sms');
            Yii::error('cURL verbose log: ' . $verboseLog, 'sms');
            
            // Provide more specific error messages based on error codes
            switch ($errno) {
                case 6:
                    throw new \Exception('Could not resolve host. Please check DNS settings.');
                case 7:
                    throw new \Exception('Could not connect to host. Please check network connectivity.');
                case 28:
                    throw new \Exception('Connection timed out. Please try again later.');
                case 35:
                    throw new \Exception('SSL/TLS connection error. Please check SSL configuration.');
                default:
                    throw new \Exception('cURL execution failed: ' . $error . ' (errno: ' . $errno . ')');
            }
        }
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Log the response and verbose output for debugging
        Yii::info('SMS API Response: ' . $response . ' (HTTP Code: ' . $httpCode . ')', 'sms');
        Yii::info('cURL verbose log: ' . $verboseLog, 'sms');
        
        if ($httpCode !== 200) {
            throw new \Exception('SMS API returned HTTP code: ' . $httpCode . '. Response: ' . $response);
        }
        
        // Parse response to check for API errors
        $responseData = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if (isset($responseData['return']) && $responseData['return'] === false) {
                throw new \Exception('SMS API error: ' . ($responseData['message'] ?? 'Unknown error'));
            }
        }
        
        return $response;
    }
    
    private function sendSMSWithFileGetContents($numbers, $variables_values) {
        // Fallback method using file_get_contents
        $apiKey = 'RSyJt9aO7pfXx05sUqwDW4IiYQ3bECGNVKHLTuvncA6zgeZ1kmpTbhaQs8Hy2ZLOBMDFlJY4R96SoiIq';
        $senderId = 'RYLTHR';
        $route = 'dlt';
        $postData = array(
            'sender_id' => $senderId,
            'message' => '167334',
            'language' => 'english',
            'route' => $route,
            'numbers' => $numbers,
            'variables_values' => $variables_values,
        );
        
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => array(
                    'authorization: ' . $apiKey,
                    'content-type: application/json',
                    'Content-Length: ' . strlen(json_encode($postData))
                ),
                'content' => json_encode($postData),
                'timeout' => 30,
                'ignore_errors' => true
            )
        ));
        
        $response = @file_get_contents('https://www.fast2sms.com/dev/bulkV2', false, $context);
        
        if ($response === false) {
            $error = error_get_last();
            throw new \Exception('file_get_contents failed: ' . ($error['message'] ?? 'Unknown error'));
        }
        
        // Get HTTP response code from headers
        $httpCode = null;
        if (isset($http_response_header[0])) {
            preg_match('/HTTP\/\d\.\d\s+(\d+)/', $http_response_header[0], $matches);
            $httpCode = isset($matches[1]) ? intval($matches[1]) : null;
        }
        
        Yii::info('SMS API Response (fallback): ' . $response . ' (HTTP Code: ' . $httpCode . ')', 'sms');
        
        if ($httpCode !== 200) {
            throw new \Exception('SMS API returned HTTP code: ' . $httpCode . '. Response: ' . $response);
        }
        
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
        $arr['product'] = $this->getBookingCategory($booking->product);
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
        
        // Ordering - default to descending by ID for newest bookings first
        $columns = ['id', 'name', 'phone', 'type', 'product', 'belowtenyears', 'abovetenyears', 'no_of_units', 'date', 'ticket_no'];
        if (isset($columns[$orderColumn])) {
            $query->orderBy([$columns[$orderColumn] => $orderDir === 'asc' ? SORT_ASC : SORT_DESC]);
        } else {
            // Default to descending by ID (newest first)
            $query->orderBy(['id' => SORT_DESC]);
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
    /**
     * Get booking category name
     */
    private function getBookingCategory($product)
    {
        // Try dynamic lookup first
        $pricing = \app\models\Pricing::findOne(['product_code' => $product]);
        if ($pricing) {
            return $pricing->name;
        }

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
        // Allow verify if not visited yet (using OTP)
        if (($booking->visited == 0) && ($booking->otp != null)) {
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
        // Allow resend if not visited yet
        if ($booking->visited == 0) {
            return '<button type="button" class="btn btn-warning" onclick="resendOtp(' . $booking->id . ')">Resend Otp</button>';
        } else {
            return '';
        }
    }

    public function actionGetTicketDetails()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $code = Yii::$app->request->post('code');
        if (!$code) {
            return ['success' => false, 'message' => 'No code received'];
        }
        $booking = null;
        $data = json_decode($code, true);
        
        // Handle JSON format
        if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
            if(isset($data['ticket'])) {
                 $booking = Booking::find()->where(['ticket_no' => $data['ticket']])->one();
            } elseif(isset($data['ticket_no'])) {
                 $booking = Booking::find()->where(['ticket_no' => $data['ticket_no']])->one();
            } elseif(isset($data['booking_id'])) {
                 $booking = Booking::findOne($data['booking_id']);
            }
        } else {
            $booking = Booking::find()->where(['ticket_no' => $code])->one();
        }
        
        if (!$booking) {
            return ['success' => false, 'message' => 'Invalid ticket code'];
        }
        
        $cat = $this->getBookingCategory($booking->product);
        $msg = "
            <div class='text-left'>
                <p><strong>Name:</strong> {$booking->name}</p>
                <p><strong>Ticket:</strong> {$booking->ticket_no}</p>
                <p><strong>Product:</strong> {$cat}</p>
                <p><strong>Below 10 Years:</strong> {$booking->belowtenyears}</p>
                <p><strong>Above 10 Years:</strong> {$booking->abovetenyears}</p>
                <p><strong>Total Persons:</strong> {$booking->no_of_units}</p>
                <p><strong>Date:</strong> " . date('d-m-Y', strtotime($booking->date)) . "</p>
                <p><strong>Status:</strong> ". ($booking->visited == 1 ? '<span class="label label-danger">Already Visited</span>' : '<span class="label label-success">Valid</span>') ."</p>
            </div>
        ";

        return [
            'success' => true, 
            'message' => 'Ticket Found',
            'details' => $msg,
            'booking_id' => $booking->id,
            'is_visited' => $booking->visited
        ];
    }

    public function actionMarkVerified() 
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('booking_id');
        $booking = Booking::findOne($id);

        if (!$booking) {
            return ['success' => false, 'message' => 'Booking not found'];
        }

        if ($booking->visited == '1') {
            return ['success' => false, 'message' => 'Already marked as visited'];
        }

        $booking->visited = 1;
        if($booking->save(false)) {
            return ['success' => true, 'message' => 'Entry Approved Successfully!'];
        }
        return ['success' => false, 'message' => 'Database Error'];
    }
}
