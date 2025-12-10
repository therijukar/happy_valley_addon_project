<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $key_name
 * @property string $value
 */
class Settings extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_name', 'value'], 'required'],
            [['key_name'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 255],
            [['key_name'], 'unique'],
        ];
    }

    public static function getReferralBonus()
    {
        $setting = self::findOne(['key_name' => 'referral_bonus']);
        return $setting ? (float)$setting->value : 0.00;
    }
}
