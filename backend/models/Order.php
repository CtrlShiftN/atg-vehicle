<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $uuid
 * @property int $customer_id
 * @property int $vehicle_id
 * @property int $quantity
 * @property int $ship_method 1 for RORO, 2 for container shipping, 3 for get it directly
 * @property string|null $ship_date
 * @property int $ship_fee 0 for free ship
 * @property int $status 0 for inactive, 1 for active
 * @property string|null $note
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'vehicle_id', 'quantity', 'created_at'], 'required'],
            [['customer_id', 'vehicle_id', 'quantity', 'ship_method', 'ship_fee', 'status'], 'integer'],
            [['ship_date', 'created_at', 'updated_at'], 'safe'],
            [['note'], 'string'],
            [['uuid'], 'string', 'max' => 255],
            [['uuid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'vehicle_id' => Yii::t('app', 'Vehicle ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'ship_method' => Yii::t('app', 'Ship Method'),
            'ship_date' => Yii::t('app', 'Ship Date'),
            'ship_fee' => Yii::t('app', 'Ship Fee'),
            'status' => Yii::t('app', 'Status'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
