<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile
	 */
	public $imageFile;
    public $csv;
    public $doc;

	public function rules()
	{
		return [
				[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
 [['csv'], 'file', 'skipOnEmpty' => false, 'extensions'=>['xls', 'xlsx'],
     'checkExtensionByMimeType'=>false, 'maxSize'=>1024 * 1024 * 5],
        [['doc'], 'file', 'skipOnEmpty' => false, 'extensions'=>['doc', 'docx', 'pdf'], 'checkExtensionByMimeType'=>false, 'maxSize'=>1024 * 1024 * 5],
		];

	}


    public function geoexcelUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->csv->baseName . '.' . $this->csv->extension;
        $filename = str_replace(' ', '', $filename);
        $this->csv->saveAs('uploads/client_excel/' . $filename);
        chmod("uploads/client_excel/".$filename, 0644);

        return $filename;
    }

    public function videothumbUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=$rnd.'_'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
        $filename = str_replace(' ', '', $filename);
        $this->csv->saveAs('uploads/video_thumb/' . $filename);
        chmod("uploads/video_thumb/".$filename, 0644);

        return $filename;
    }

    public function ridesimgUpload(){
        $filename='';
        $filename=uniqid().'-'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
        $filename = str_replace(' ', '-', $filename);
        $this->imageFile->saveAs('web/assets/images/ride/'.$filename);
        chmod("web/assets/images/ride/".$filename, 0644);
        return $filename;
    }

    public function eventsimgUpload(){
        $filename='';
        $rnd  = rand(0,9999);

        $filename=uniqid().'-'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
        $filename = str_replace(' ', '-', $filename);
        $this->imageFile->saveAs('uploads/Events/' . $filename);
        chmod("uploads/Events/".$filename, 0644);
        return $filename;
    }

    

}