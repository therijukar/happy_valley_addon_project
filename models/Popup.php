<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "popup".
 *
 * @property int $id
 * @property string $title
 * @property string $image_url
 * @property int $status
 * @property string $created_at
 */
class Popup extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'popup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_url'], 'required', 'on' => 'create'], // Required only on create
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'image_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image_url' => 'Image URL',
            'status' => 'Active Status',
            'created_at' => 'Created At',
        ];
    }
}
