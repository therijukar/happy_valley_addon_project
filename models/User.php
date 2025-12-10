<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $phone
 * @property string $auth_key
 * @property string $access_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['phone'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['access_token', 'full_name', 'email_id'], 'string', 'max' => 255],
            [['phone'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Decode JWT token here or validate simple token
        // For simplicity with JWT, we might need a helper to decode first,
        // but here we just check if it matches the stored one (if we store it).
        // Since we are using JWT, we should actually verify the token signature 
        // and extract ID. But for now, let's assume we decode it in the controller 
        // or a behavior and pass the ID.
        // Actually, standard Yii2 method signature expects a token string.
        
        try {
            $key = 'happyvalley_secret_key'; // Use a param or config
            $decoded = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));
            return static::findOne($decoded->sub);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Finds user by phone
     *
     * @param string $phone
     * @return static|null
     */
    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->created_at = time();
                $this->updated_at = time();
                $this->generateAuthKey();
            } else {
                $this->updated_at = time();
            }
            return true;
        }
        return false;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    public function generateAccessToken()
    {
       // This logic effectively moves to AuthController to generate JWT
       // But we can store a reference if needed.
    }
}
