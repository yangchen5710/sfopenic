<h1 align="center"> sfopenic </h1>

<p align="center"> 顺丰同城开放平台SDK </p>


## 安装

```shell
$ composer require ycstar/sfopenic -vvv
```

## 配置

在使用本扩展之前,你需要去[顺丰同城开放平台](http://commit-openic.sf-express.com/open/api/docs/index#/homepage)注册账号,然后申请开发者ID,获取相应的配置

## 使用
```php
    use Ycstar\Sfopenic\Sfopenic;

    $config = [
        'host'    => 'xxxxxxxxxxxx',
        'dev_id'  => 'xxxxxxxxxxxx',
        'dev_key' => 'xxxxxxxxxxxx'
    ];

    $sfopenic = new Sfopenic($config);
```

## 预创建订单
```php
    $data = [
        'shop_id' => 'xxxxxxxxxxxx',
        'user_address' => "北京市海淀区学清嘉创大厦A座15层",
        'user_lng' => '116.352569',
        'user_lat' => '40.014838',
        'weight' => 100,
        'product_type' => 1,
        'pay_type' => 1,
        'is_appoint' => 0,
        'is_insured' => 0,
        'is_person_direct' => 0
    ];

    $res = $sfopenic->preCreateOrder($data);
```

## 创建订单
```php
    $array = [
        'shop_id' => 'xxxxxxxxxxxx',
        'shop_order_id' => 'xxxxxxxxxxxx',
        'order_source' => 'xx',
        'pay_type' => 1,
        'order_time' => time(),
        'is_appoint' => 0,
        'is_insured' => 0,
        'is_person_direct' => 0,
        'version' => 17,
        'order_sequence' => 'xx',
        'remark' => 'xx'
    ];

    $receive =[
        'user_name' => "xx",
        'user_phone' => "xxxxxxxxxx",
        'user_address' => "北京市海淀区学清嘉创大厦A座15层",
        'user_lng' => '116.352569',
        'user_lat' => '40.014838',
    ];

    $order_detail = [
        'total_price' => 1,//总金额
        'product_type' => 1, //物品类型 1:送餐 8:饮品
        'weight_gram' => 100,//物品重量
        'product_num' => 3,//物品个数
        'product_type_num' => 1,//物品种类个数
    ];

    $product_detail[]=[
        'product_name'=>'xxx',//物品名称
        'product_num' => 1,//物品数量
    ];

    $order_detail['product_detail'] = $product_detail;

    $array['order_detail'] = $order_detail;

    $array['receive'] = $receive;

    $res = $sfopenic->createOrder($data);
```

## 取消订单
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
        'cancel_code' => 313, //不填时默认cancel_code=313,cancel_reason=商家发起取消
        'cancel_reason' => ''
    ];

    $res = $sfopenic->cancelOrder($data);
```

## 预取消订单
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
        'cancel_reason' => ''
    ];

    $res = $sfopenic->preCancelOrder($data);
```

## 订单加小费
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
        'gratuity_fee' => 0
    ];

    $res = $sfopenic->addOrderGratuityFee($data);
```

## 获取订单加小费信息
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->getOrderGratuityFee($data);
```

## 订单状态流查询
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->listOrderFeed($data);
```

## 订单实时信息查询
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->getOrderStatus($data);
```

## 催单
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->reminderOrder($data);
```

## 改单
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
        'user_name'=> '',
        'user_phone'=> '',
        'user_address'=> '',
        'lbs_type'=> 2, //1：百度坐标，2：高德坐标（默认值为2，下面的经纬度依赖这个坐标系，不传默认高德）
        'user_lng'=> '', //传入用户地址经纬度顺丰侧则不根据用户地址解析
        'user_lat'=> '',
    ];

    $res = $sfopenic->changeOrder($data);
```

## 获取配送员实时坐标接口
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->riderLatestPosition($data);
```

## 获取配送员轨迹H5
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,   //order_type=2时必传shop_id与shop_type
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->riderViewV2($data);
```

## 订单回调详情
```php
    $data = [
        'order_id' => 'xxxxxxxxxxxx',
        'order_type' => 1 //1、顺丰订单号 2、商家订单号
        'shop_id' => 0,
        'shop_type' => 1, //1、顺丰店铺ID 2、接入方店铺ID
    ];

    $res = $sfopenic->getCallbackInfo($data);
```

## 在laravel中使用

在 Laravel 中使用也是同样的安装方式，

使用下面的命令来导出配置文件
```php
php artisan vendor:publish --tag="ycstar-sfopenic"
```

配置写在 config/sfopenic.php 中:
```php
    return [
    
        'host' => env('SF_OPENIC_HOST'),

        'dev_id' => env('SF_OPENIC_DEV_ID'),

        'dev_key' => env('SF_OPENIC_DEV_KEY')

      ];
```
然后在 .env 中配置 SF_OPENIC_HOST, SF_OPENIC_DEV_ID, SF_OPENIC_DEV_KEY:
```php
    SF_OPENIC_HOST = xxxxxxxxxxxx
    SF_OPENIC_DEV_ID = xxxxxxxxxxxx
    SF_OPENIC_DEV_KEY = xxxxxxxxxxxx
```
可以用两种方式来获取 Ycstar\Sfopenic\Sfopenic 实例：

* 方法参数注入
  ```php
    .
    .
    .
    public function preCreateOrder(Sfopenic $sfopenic)
    {
        $res = $sfopenic->preCreateOrder($data);
    }
    .
    .
    .
  ```
* 服务名访问
  ```php
    .
    .
    .
    public function preCreateOrder()
    {
        $res = app('sfopenic')->preCreateOrder($data);
    }
    .
    .
    .
  ```

## 参考
* [顺丰同城开放平台接口文档](http://commit-openic.sf-express.com/open/api/docs/index#/apidoc)

## License

MIT