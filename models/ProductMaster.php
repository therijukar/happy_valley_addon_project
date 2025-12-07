<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_master".
 *
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $max_unit
 * @property string $created_date
 * @property int $created_by
 * @property string $modified_date
 * @property int $modified_by
 * @property int $is_active 1=active,0=inactive
 * @property int $soft_delete 0=not deleted,1=deleted
 *
 * @property AddonMaster[] $addonMasters
 * @property BookingProd[] $bookingProds
 */
class ProductMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price','name','max_unit'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['created_date', 'modified_date'], 'safe'],           
            [['created_by', 'modified_by', 'is_active', 'soft_delete'], 'integer'],
            [['name', 'price', 'max_unit'], 'string', 'max' => 255],
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
            'price' => 'Price',
            'max_unit' => 'Max Unit',
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
    public function getAddonMasters()
    {
        return $this->hasMany(AddonMaster::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingProds()
    {
        return $this->hasMany(BookingProd::className(), ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductMasterQuery(get_called_class());
    }
}
