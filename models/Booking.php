<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $belowtenyears 
 * @property int $abovetenyears 
 * @property int $no_of_units
 * @property int $user_id
 * @property string $product 1=restaurant,2=banquet,3=picnic spots,4=book ticket,5=water park + park ride,6=5D Ticket Booking, 7= Full Package,8=Water World 
 * @property double $amount
 * @property string $date
 * @property string $type 0='Mobile',1='WEB'
 * @property string $ticket_no
 * @property int $visited 1=visited,0=not-visited
 * @property string $created_date
 * @property int $created_by
 * @property string $modified_date
 * @property int $modified_by
 * @property int $is_active 1=active,0=inactive
 * @property int $soft_delete 0=not deleted,1=deleted
 *
 * @property Payments[] $payments
 * @property Payment $payment
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['belowtenyears', 'abovetenyears', 'no_of_units', 'visited', 'created_by', 'modified_by', 'is_active', 'soft_delete', 'user_id', 'status'], 'integer'],
            [['product'], 'required'],
            [['product', 'type'], 'string'],
            [['amount'], 'number'],
            [['date', 'created_date', 'modified_date'], 'safe'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
            [['ticket_no'], 'string', 'max' => 10],
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
            'belowtenyears' => 'Belowtenyears', 
            'abovetenyears' => 'Abovetenyears', 
            'no_of_units' => 'No Of Units',
            'product' => 'Product', 
            'amount' => 'Amount',
            'date' => 'Date',
            'type' => 'Type',
            'ticket_no' => 'Ticket No',
            'visited' => 'Visited',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
            'is_active' => 'Is Active',
            'soft_delete' => 'Soft Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['booking_id' => 'id']);
    }
    
    public function getPayment()
    {
        return $this->hasOne(Payments::className(), ['booking_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BookingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookingQuery(get_called_class());
    }
}
