<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $product 1=restaurant,2=banquet,3=picnic spots
 * @property string $from_date
 * @property string $to_date
 * @property string $time
 * @property int $no_of_people
 * @property int $no_of_spots
 * @property string $type 1=web,0=mobile
 * @property string $created_date
 * @property int $soft_delete 0=not deleted, 1= deleted
 */
class Enquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product', 'type'], 'string'],
            [['from_date', 'to_date', 'time', 'created_date'], 'safe'],
            [['no_of_people', 'no_of_spots', 'soft_delete'], 'integer'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'product' => 'Product',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'time' => 'Time',
            'no_of_people' => 'No Of People',
            'no_of_spots' => 'No Of Spots',
            'type' => 'Type',
            'created_date' => 'Created Date',
            'soft_delete' => 'Soft Delete',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EnquiryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EnquiryQuery(get_called_class());
    }
}
