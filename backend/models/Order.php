<?php

namespace backend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $uuid
 * @property int $customer_id
 * @property int $vehicle_id
 * @property int $quantity
 * @property int $total_price
 * @property int $ship_method 1 for RORO, 2 for container shipping, 3 for get it directly
 * @property string|null $ship_date
 * @property int $ship_fee 0 for free ship
 * @property int $created_by
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
            [['uuid', 'customer_id', 'vehicle_id', 'quantity', 'total_price', 'created_at'], 'required'],
            [['customer_id', 'vehicle_id', 'quantity', 'total_price', 'ship_method', 'ship_fee', 'created_by', 'status'], 'integer'],
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
            'total_price' => Yii::t('app', 'Total Price'),
            'ship_method' => Yii::t('app', 'Ship Method'),
            'ship_date' => Yii::t('app', 'Ship Date'),
            'ship_fee' => Yii::t('app', 'Ship Fee'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function getOrderDetailByUuid($uuid)
    {
        $row = (new Query())
            ->select(['o.uuid', 'u.name', 'u.email', 'u.address', 'u.tel', 'v.SKU', 'v.name', 'v.selling_price', 'o.quantity', 'o.total_price'])
            ->from('order as o')
            ->innerJoin('vehicle as v', 'o.vehicle_id = v.id')
            ->innerJoin('user as u', 'o.customer_id = u.id')
            ->where(['o.uuid' => $uuid])->all();
        return $row;
    }

    /**
     * 
     */
    public static function updateDetails($uuid, $manufacturer, $model, $totalPrice)
    {
        $countSuccess = 0;
        $order = Order::findOne(['uuid' => $uuid]);
        if (!empty($order->id)) {
            $order->total_price = $totalPrice;
            $vehicleID = $order->vehicle_id;
            if($order->save()) {
                $countSuccess += 1;
            }
            $vehicle = Vehicle::findOne($vehicleID);
            if (!empty($vehicle->id)) {
                $vehicle->manufacturer = $manufacturer;
                $vehicle->model = $model;
                if($vehicle->save()) {
                    $countSuccess += 1;
                }
            } else {
                return "Vehicle not found";
            }

            return $countSuccess;
        } else {
            return "Order not found";
        }
    }
}
