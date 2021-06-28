<?php
namespace Ycstar\Sfopenic\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery\Matcher\AnyArgs;
use Ycstar\Sfopenic\Exceptions\HttpException;
use Ycstar\Sfopenic\Sfopenic;
use PHPUnit\Framework\TestCase;

class SfopenicTest extends TestCase
{
    protected $host = "https://openic.sf-express.com";

    protected $dev_id = '1524853076';

    protected $dev_key = '5178d26cc019e9578d386725343bf9ca';

    /**
     * [preCreateOrder description]
     * @description
     * 预创建订单
     * @author ycstar
     * @dateTime    2021-06-25T15:55:56+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function testPreCreateOrder()
    {
        $post_data = [
            'dev_id' => $this->dev_id,
            'shop_id' => '3243279847393',
            'user_lng' => '116.352569',
            'user_lat' => '40.014838',
            'user_address' => "北京市海淀区学清嘉创大厦A座15层",
            'weight' => 100,
            'product_type' => 1,
            'pay_type' => 1,
            'is_appoint' => 0,
            'is_insured' => 0,
            'is_person_direct' => 0,
            'push_time' => time()
        ];

        $response = new Response(200, [], '{"success": true}');
        $client = \Mockery::mock(Client::class);

        $sign = $this->getSign($post_data);

        $url = "{$this->host}/open/api/external/precreateorder?sign={$sign}";

        $client->allows()->post($url, [
                 'json'=>$post_data
                ]
        )->andReturn($response);

        $w = \Mockery::mock(Sfopenic::class, [$this->host,$this->dev_id,$this->dev_key])->makePartial();
        $w->allows()->getHttpClient()->andReturn($client);

        $this->assertSame(['success' => true], $w->preCreateOrder($post_data));



        /*try{

            $response = $this->clinet_post($action = 'precreateorder',$array);
            return $response;

        }catch(\Exception $e){

            throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }*/


    }

    public function testCreateOrder()
    {
        $array = [
            'shop_id' => 3243279847393,
            'shop_order_id' => '123456',//我们这边的订单号
            'order_source' => '微信',//订单来源(微信，线下，饿了么，美团)
            'pay_type' => 1,
            'order_time' => strtotime("2021-06-28 13:11:00"),//用户下单时间
            'is_appoint' => 0,
            'is_insured' => 0,
            'is_person_direct' => 0,
            'version' => 17,
            'order_sequence' => '1234',
            'remark' => '加饭',
            'return_flag' => '511'
        ];

        $receive =[
            'user_name' => "杨晨",
            'user_phone' => "19951568088",
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

        $product_detail = [];

        $product_detail[]=[
            'product_name'=>'拿铁',//物品名称
            'product_num' => 1,//物品数量
        ];

        $order_detail['product_detail'] = $product_detail;

        $array['order_detail'] = $order_detail;

        $array['receive'] = $receive;

        $response = new Response(200, [], '{"success": true}');
        $client = \Mockery::mock(Client::class);

        $sign = $this->getSign($post_data);

        $url = "{$this->host}/open/api/external/precreateorder?sign={$sign}";

        $client->allows()->post($url, [
                 'json'=>$post_data
                ]
        )->andReturn($response);

        $w = \Mockery::mock(Sfopenic::class, [$this->host,$this->dev_id,$this->dev_key])->makePartial();
        $w->allows()->getHttpClient()->andReturn($client);

        $this->assertSame(['success' => true], $w->createOrder($post_data));

    }

    /**
     * [cancelOrder description]
     * @description
     * 取消订单
     * @author ycstar
     * @dateTime    2021-06-25T15:59:07+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function cancelOrder($array)
    {
        $response = $this->clinet_post($action = 'cancelorder',$array);

        return $response;
    }

    /**
     * [preCancelOrder description]
     * @description
     * 预取消订单
     * @author ycstar
     * @dateTime    2021-06-25T15:59:19+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function preCancelOrder($array)
    {
        $post_data = [
            'dev_id' => 1524853076,
            'order_id' => '3407604545392708097',
            'order_type' => '1',
            'shop_id' => '3243279847393',
            'push_time' => time()
        ];
        $response = $this->clinet_post($action = 'precancelorder',$array);

        return $response;
    }



    public function clinet_post($action,$post_data)
    {
        $sign = $this->getSign($post_data);

        $url = "{$this->host}/open/api/external/{$action}?sign={$sign}";

        $data = $this->getHttpClient()->post($url, [
                 'json'=>$post_data
                ]
        )->getBody()->getContents();

        return $data;
    }

    public function getSign($post_data)
    {
        $post_json = json_encode($post_data);

        $signChar  = $post_json . "&{$this->dev_id}&{$this->dev_key}";

        return base64_encode(MD5($signChar));
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }


}



