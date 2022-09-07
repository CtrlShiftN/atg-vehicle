<?php

namespace backend\controllers\api;

use backend\models\Order;
use common\components\helpers\HeaderHelper;
use common\components\helpers\ParamHelper;
use common\components\helpers\StringHelper;
use common\components\SystemConstant;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class OrderController extends ActiveController
{
    public $modelClass = 'backend\models\Order';

    public function init()
    {
        // Inherit innit
        parent::init();

        // Action để handle các lỗi phát sinh dưới dạng json
        Yii::$app->errorHandler->errorAction = 'api/error/print-json';
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ],
                ],
            ],
        ]);
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        // only allow some domain to access this
        HeaderHelper::getHeaderAccessControlAllowOrigin();
        // avoid csrf validation
        if ($this->action->id == 'index') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Order::find()->where(['status' => SystemConstant::STATUS_ACTIVE]),
        ]);
    }

    public function actionView($id)
    {
        return Order::findOne($id);
    }

    /**
     * @param \yii\base\Action $action
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     * 
     */
    public function actionCreateNewOrder()
    {
        $customerId = ParamHelper::getParamValue('customer_id');
        $vehicleId = ParamHelper::getParamValue('vehicle_id');
        $quantity = ParamHelper::getParamValue('quantity');
        $shipMethod = ParamHelper::getParamValue('ship_method');
        $shipDate = ParamHelper::getParamValue('ship_date');
        $shipFee = ParamHelper::getParamValue('ship_fee');
        if (empty($customerId) || empty($vehicleId) || empty($quantity) || empty($shipMethod) || empty($shipDate) || strlen($shipFee) < 1) {
            echo json_encode([
                'status' => SystemConstant::API_UNSUCCESS_STATUS,
                'data' => ['message' => 'Missing required parameters'],
            ]);
            return;
        }
        $createdBy = $customerId;
        if (empty($customerId)) {
            $createdBy = Yii::$app->user->identity->getId();
        }
        $order = new Order();
        $order->uuid = StringHelper::genUuid();
        $order->customer_id = $customerId;
        $order->vehicle_id = $vehicleId;
        $order->ship_method = $shipMethod;
        $order->ship_date = date("Y-m-d", strtotime($shipDate));
        $order->ship_fee = $shipFee;
        $order->created_by = $createdBy;
        $order->quantity = $quantity;
        $order->created_at = date('Y-m-d H:i:s');
        $order->updated_at = date('Y-m-d H:m:s');
        if ($order->save()) {
            echo json_encode([
                'status' => SystemConstant::API_SUCCESS_STATUS,
                'data' => ['uuid' => $order->uuid]
            ]);
        } else {
            echo json_encode([
                'status' => SystemConstant::API_UNSUCCESS_STATUS,
                'data' => ['message' => '123']
            ]);
        }
    }

    /**
     * Get all details of the order by its uuid
     */
    public function actionGetOrderDetails()
    {
        $uuid = ParamHelper::getParamValue('uuid');
        if (empty($uuid)) {
            echo json_encode([
                'status' => SystemConstant::API_UNSUCCESS_STATUS,
                'data' => ['message' => 'Missing parameter uuid'],
            ]);
            return;
        }
        $orderDetail = Order::getOrderDetailByUuid($uuid);
        if (count($orderDetail) > 0) {
            echo json_encode([
                'status' => SystemConstant::API_SUCCESS_STATUS,
                'data' => $orderDetail,
            ]);
            return;
        } else {
            echo json_encode([
                'status' => SystemConstant::API_UNSUCCESS_STATUS,
                'data' => ['message' => 'Order not found'],
            ]);
            return;
        }
    }


    public function actionUpdateOrder()
    {
        $uuid = ParamHelper::getParamValue('uuid');
    }
}
