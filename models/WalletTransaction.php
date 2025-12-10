<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "wallet_transactions".
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property string $type
 * @property string $description
 * @property int $created_at
 *
 * @property User $user
 */
class WalletTransaction extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'type', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['amount'], 'number'],
            [['type'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
