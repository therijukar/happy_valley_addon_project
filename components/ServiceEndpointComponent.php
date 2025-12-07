<?php
namespace app\components;
use Yii;
use yii\base\Component;
class ServiceEndpointComponent extends Component
{
	public $serviceHelper;
	public $return;
	function __construct()
	{
		$this->serviceHelper = new ServicehelperComponent();
		$this->return = array();
	}

     public function Booking($inputJSON)
    {
        Yii::info('Inside ServiceEndpointComponent.Booking with Input parameter' . $inputJSON . 'service');
        $this->return = $this->serviceHelper->BookingHelper($inputJSON);
        print_r(json_encode($this->return));
    }

    public function Enquiry($inputJSON)
    {
        Yii::info('Inside ServiceEndpointComponent.Enquiry with Input parameter' . $inputJSON . 'service');
        $this->return = $this->serviceHelper->EnquiryHelper($inputJSON);
        print_r(json_encode($this->return));
    }

    public function feedback($inputJSON)
    {
        Yii::info('Inside ServiceEndpointComponent.Feedback with Input parameter' . $inputJSON . 'service');
        $this->return = $this->serviceHelper->FeedbackHelper($inputJSON);
        print_r(json_encode($this->return));
    }
    
}