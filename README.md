<h1 align="center"> sfopenic </h1>

<p align="center"> 顺丰同城开放平台SDK.</p>


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

## 创建预订单
```php
   $data = [
        'dev_id' => 'xxxxxxxxxxxx',
        'shop_id' => 'xxxxxxxxxxxx',
        'user_lng' => 'xxxxxxxxxxxx',
        'user_lat' => 'xxxxxxxxxxxx',
        'user_address' => "xxxxxxxxxxxx",
        'weight' => 100,
        'product_type' => 1,
        'pay_type' => 1,
        'is_appoint' => 0,
        'is_insured' => 0,
        'is_person_direct' => 0,
        'push_time' => time()
    ];

    $res = $sfopenic->preCreateOrder($data);
```

## 在laravel中使用
在 Laravel 中使用也是同样的安装方式，配置写在 config/services.php 中:
```php
    .
    .
    .
    'sfopenic' => [
        'host' => env('SF_OPENIC_HOST'),
        'dev_id' => env('SF_OPENIC_DEV_ID'),
        'dev_key' => env('SF_OPENIC_DEV_KEY')
    ],
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
        $res = app('sfopenic')->>preCreateOrder($data);
    }
    .
    .
    .
  ```

## 参考
* [顺丰同城开放平台接口文档](http://commit-openic.sf-express.com/open/api/docs/index#/apidoc)

## License

MIT