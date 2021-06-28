<?php
namespace Ycstar\Sfopenic;

use GuzzleHttp\Client;

use Ycstar\Sfopenic\Exceptions\HttpException;

class Sfopenic
{
    protected $host;

    protected $dev_id;

    protected $dev_key;

    protected $guzzleOptions = [];

    public function __construct(string $host, string $dev_id, string $dev_key)
    {
        $this->host = $host;
        $this->dev_id = $dev_id;
        $this->dev_key = $dev_key;
    }

    /**
     * [createOrder description]
     * @description
     * 创建订单
     * @author ycstar
     * @dateTime    2021-06-25T15:55:23+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function createOrder(array $data)
    {
        /*$array = [
            'dev_id' => $this->dev_id,
            'shop_id' => $order->store->sf_shop_id,
            'shop_order_id' => $order->order_num,//我们这边的订单号
            'order_source' => $order->order_source,//订单来源(微信，线下，饿了么，美团)
            'pay_type' => 1,
            'order_time' => strtotime($order->paytime),//用户下单时间
            'is_appoint' => 0,
            'is_insured' => 0,
            'is_person_direct' => 0,
            'push_time' => time(),
            'version' => 17,
            'order_sequence' => $order->verify_code,
            'remark' => $order->remark
        ];

        $receive =[
            'user_name' => $order->user_name,
            'user_phone' => $order->user_tel,
            'user_address' => $order->user_address,
            'user_lng' => $order->longitude,
            'user_lat' => $order->latitude
        ];

        $order_detail = [
            'total_price' => ($order->due)*100,//总金额
            'product_type' => 1, //物品类型 1:送餐 8:饮品
            'weight_gram' => 100,//物品重量
            'product_num' => 3,//物品个数
            'product_type_num' => 1,//物品种类个数
        ];

        $product_detail = [];
        foreach ($order_detail_ids_array as $key => $value) {
                $order_detail_obj = OrderDetail::where('id','=',$value)->first();
                $product_detail[]=[
                    'product_name'=>$order_detail_obj->goods_name,//物品名称
                    'product_num' => 1,//物品数量
                ];
        }
        $order_detail['product_detail'] = $product_detail;

        $array['order_detail'] = $order_detail;

        $array['receive'] = $receive;*/

        try{

            $response = $this->clinet_post($action = 'createorder',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

            throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [preCreateOrder description]
     * @description
     * 预创建订单
     * @author ycstar
     * @dateTime    2021-06-25T15:55:56+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function preCreateOrder(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'precreateorder',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

            throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
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
    public function cancelOrder(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'cancelorder',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
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
    public function preCancelOrder(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'precancelorder',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [addOrderGratuityFee description]
     * @description
     * 订单加小费
     * @author ycstar
     * @dateTime    2021-06-28T14:20:32+0800
     * @param       [type]                   $array [description]
     */
    public function addOrderGratuityFee(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'addordergratuityfee',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [getOrderGratuityFee description]
     * @description
     * 获取订单加小费信息
     * @author ycstar
     * @dateTime    2021-06-28T14:22:48+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function getOrderGratuityFee(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'getordergratuityfee',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [listOrderFeed description]
     * @description
     * 订单状态流查询
     * @author ycstar
     * @dateTime    2021-06-28T14:24:10+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function listOrderFeed(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'listorderfeed',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [getOrderStatus description]
     * @description
     * 订单实时信息查询
     * @author ycstar
     * @dateTime    2021-06-28T14:25:16+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function getOrderStatus(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'getorderstatus',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [reminderorder description]
     * @description
     * 催单
     * @author ycstar
     * @dateTime    2021-06-28T14:25:56+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function reminderOrder(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'reminderorder',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [changeOrder description]
     * @description
     * 改单
     * @author ycstar
     * @dateTime    2021-06-28T14:27:21+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function changeOrder(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'changeorder',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [riderLatestPosition description]
     * @description
     * 获取配送员实时坐标
     * @author ycstar
     * @dateTime    2021-06-28T14:28:23+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function riderLatestPosition(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'riderlatestposition',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [riderViewV2 description]
     * @description
     * 获取配送员轨迹H5
     * @author ycstar
     * @dateTime    2021-06-28T14:29:44+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function riderViewV2(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'riderviewv2',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
    }

    /**
     * [getCallbackInfo description]
     * @description
     * 订单回调详情
     * @author ycstar
     * @dateTime    2021-06-28T14:30:28+0800
     * @param       [type]                   $array [description]
     * @return      [type]                          [description]
     */
    public function getCallbackInfo(array $data)
    {
        try{

            $response = $this->clinet_post($action = 'getcallbackinfo',$data);

            return json_decode($response,true);

        }catch(\Exception $e){

           throw new HttpException($e->getMessage(), $e->getCode(), $e);

        }
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



