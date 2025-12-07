<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pricing".
 *
 * @property int $id
 * @property int $product_code
 * @property string $name
 * @property float $price
 * @property float $price_child
 * @property float $original_price
 * @property string $discount_label
 * @property string $description
 * @property string $updated_at
 */
class Pricing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pricing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_code', 'name', 'price'], 'required'],
            [['product_code'], 'integer'],
            [['price', 'price_child', 'original_price'], 'number'],
            [['price_child', 'original_price'], 'default', 'value' => 0], // Ensure they are not null
            [['description', 'discount_label'], 'string'],
            [['updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['product_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code (System ID)',
            'name' => 'Product Name',
            'price' => 'Adult Price',
            'price_child' => 'Child Price',
            'original_price' => 'Original Price (MRP)',
            'discount_label' => 'Discount Label',
            'description' => 'Description',
            'updated_at' => 'Last Updated',
        ];
    }
}
