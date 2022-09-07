<?php

namespace backend\controllers;

use backend\models\Order;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $customerId = 3;
        $vehicleId = 2;
        $quantity = 3;
        $shipMethod = 2;
        $shipDate = '2022-09-22';
        $shipFee = 0;
        $order = Order::createOrder($customerId, $vehicleId, $quantity, $shipMethod, $shipDate, $shipFee, $customerId);
        var_dump($order->save());die;
        return $this->render('index');
    }

}
