<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property string $id
 * @property string $booking_id
 * @property string $txn_id
 * @property string $payment_id
 * @property string $payu_money_id
 * @property string $bank_ref_no
 * @property double $amount
 * @property double $amount_paid
 * @property string $mode
 * @property string $pg_type
 * @property string $datetime
 * @property string $error_msg
 * @property string $status
 * @property int $confirmation 0=pending,1=confirmed
 * @property string $user_ip
 * @property string $created_date
 * @property string $modified_date
 * @property int $is_active 1=active,0=inactive
 * @property int $soft_delete 0=not deleted,1=deleted
 *
 * @property Booking $booking
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'confirmation', 'is_active', 'soft_delete'], 'integer'],
            [['amount', 'amount_paid'], 'number'],
            [['datetime', 'created_date', 'modified_date'], 'safe'],
            [['txn_id'], 'string', 'max' => 500],
            [['payment_id', 'payu_money_id', 'bank_ref_no', 'pg_type', 'error_msg', 'status', 'user_ip'], 'string', 'max' => 255],
            [['mode'], 'string', 'max' => 20],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_id' => 'Booking ID',
            'txn_id' => 'Txn ID',
            'payment_id' => 'Payment ID',
            'payu_money_id' => 'Payu Money ID',
            'bank_ref_no' => 'Bank Ref No',
            'amount' => 'Amount',
            'amount_paid' => 'Amount Paid',
            'mode' => 'Mode',
            'pg_type' => 'Pg Type',
            'datetime' => 'Datetime',
            'error_msg' => 'Error Msg',
            'status' => 'Status',
            'confirmation' => 'Confirmation',
            'user_ip' => 'User Ip',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'is_active' => 'Is Active',
            'soft_delete' => 'Soft Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * {@inheritdoc}
     * @return PaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentsQuery(get_called_class());
    }
}
