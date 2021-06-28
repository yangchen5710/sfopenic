<?php
namespace Ycstar\Sfopenic;

use GuzzleHttp\Client;

use Ycstar\Sfopenic\Exceptions\HttpException;

use Ycstar\Sfopenic\Exceptions\InvalidArgumentException;

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
        if(isset($data['order_type']) && $data['order_type'] == 2){
            if(!isset($data['shop_id']) || !isset($data['shop_type'])){
                throw new InvalidArgumentException('缺少参数');
            }
        }

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
        if(isset($data['order_type']) && $data['order_type'] == 2){
            if(!isset($data['shop_id']) || !isset($data['shop_type'])){
                throw new InvalidArgumentException('缺少参数');
            }
        }

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
        if(isset($data['order_type']) && $data['order_type'] == 2){
            if(!isset($data['shop_id']) || !isset($data['shop_type'])){
                throw new InvalidArgumentException('缺少参数');
            }
        }

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
        if(isset($data['order_type']) && $data['order_type'] == 2){
            if(!isset($data['shop_id']) || !isset($data['shop_type'])){
                throw new InvalidArgumentException('缺少参数');
            }
        }

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
        if(isset($data['order_type']) && $data['order_type'] == 2){
            if(!isset($data['shop_id']) || !isset($data['shop_type'])){
                throw new InvalidArgumentException('缺少参数');
            }
        }

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
        $post_data['dev_id'] = $this->dev_id;

        $post_data['push_time'] = time();

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



