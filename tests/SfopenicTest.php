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



