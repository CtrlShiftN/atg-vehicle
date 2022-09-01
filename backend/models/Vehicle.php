<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vehicle".
 *
 * @property int $id
 * @property string $SKU
 * @property string $name
 * @property int $image_id
 * @property string $image_related
 * @property int $manufacturer
 * @property string $model
 * @property string|null $series
 * @property int $color
 * @property string $engine_number
 * @property float $fuel_capacity
 * @property string $manufacture_date
 * @property int $original_price
 * @property int $selling_price
 * @property float|null $discount
 * @property int $total_quantity
 * @property int $status 0 for inactive, 1 for active
 * @property string|null $note
 * @property string $created_at
 * @property string $updated_at
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SKU', 'name', 'image_id', 'image_related', 'manufacturer', 'model', 'color', 'engine_number', 'fuel_capacity', 'manufacture_date', 'original_price', 'selling_price', 'total_quantity', 'created_at'], 'required'],
            [['image_id', 'manufacturer', 'color', 'original_price', 'selling_price', 'total_quantity', 'status'], 'integer'],
            [['fuel_capacity', 'discount'], 'number'],
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['SKU', 'name', 'image_related', 'model', 'series', 'engine_number', 'manufacture_date'], 'string', 'max' => 255],
            [['SKU'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'SKU' => Yii::t('app', 'Sku'),
            'name' => Yii::t('app', 'Name'),
            'image_id' => Yii::t('app', 'Image ID'),
            'image_related' => Yii::t('app', 'Image Related'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'model' => Yii::t('app', 'Model'),
            'series' => Yii::t('app', 'Series'),
            'color' => Yii::t('app', 'Color'),
            'engine_number' => Yii::t('app', 'Engine Number'),
            'fuel_capacity' => Yii::t('app', 'Fuel Capacity'),
            'manufacture_date' => Yii::t('app', 'Manufacture Date'),
            'original_price' => Yii::t('app', 'Original Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'discount' => Yii::t('app', 'Discount'),
            'total_quantity' => Yii::t('app', 'Total Quantity'),
            'status' => Yii::t('app', 'Status'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
