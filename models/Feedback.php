<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property string $id
 * @property string $applicant_name
 * @property string $phone
 * @property string $email
 * @property string $comment
 * @property string $created_date
 * @property int $soft_delete 0=not deleted,1=deleted
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['created_date'], 'safe'],
            [['soft_delete'], 'integer'],
            [['applicant_name', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicant_name' => 'Applicant Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'comment' => 'Comment',
            'created_date' => 'Created Date',
            'soft_delete' => 'Soft Delete',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FeedbackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedbackQuery(get_called_class());
    }
}
