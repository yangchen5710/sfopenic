<?php
namespace Ycstar\Sfopenic;

use Ycstar\Sfopenic\Exceptions\InvalidArgumentException;

use Ycstar\Sfopenic\Exceptions\InvalidMethodException;

class Sfopenic extends Base
{
    protected static $orderType2 = 2;

    protected $methods = [
        'createOrder',
        'createOrder4C',
        'preCreateOrder',
        'preCreateOrder4C',
        'cancelOrder',
        'preCancelOrder',
        'addOrderGratuityFee',
        'getOrderGratuityFee',
        'listOrderFeed',
        'getOrderStatus',
        'reminderOrder',
        'changeOrder',
        'riderLatestPosition',
        'riderViewV2',
        'getCallbackInfo',
        'notifyProductReady',
        'getShopAccountBalance',
        'getCompanyInfo',
        'getShopInfo',
    ];

    public function __call($method, array $arguments)
    {
        if (!in_array($method, $this->methods)) {
            throw new InvalidMethodException('非法的方法名');
        }

        self::checkParams(...$arguments);

        return $this->request($method, ...$arguments);
    }

    protected static function checkParams($arguments)
    {
        if (isset($arguments['order_type']) &&
            $arguments['order_type'] == self::$orderType2 &&
            (!isset($arguments['shop_id']) || !isset($arguments['shop_type']))) {
            throw new InvalidArgumentException('缺少参数');
        }
    }
}
