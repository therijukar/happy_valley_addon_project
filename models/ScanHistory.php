<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_history".
 *
 * @property int $id
 * @property string $ticket_no
 * @property int $booking_id
 * @property string $customer_name
 * @property string $scan_status
 * @property string $scanned_at
 * @property int $scanned_by
 */
class ScanHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scan_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'scanned_by'], 'integer'],
            [['scanned_at'], 'safe'],
            [['ticket_no', 'customer_name'], 'string', 'max' => 255],
            [['scan_status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_no' => 'Ticket No',
            'booking_id' => 'Booking ID',
            'customer_name' => 'Customer Name',
            'scan_status' => 'Scan Status',
            'scanned_at' => 'Scanned At',
            'scanned_by' => 'Scanned By',
        ];
    }
}
