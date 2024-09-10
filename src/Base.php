<?php
namespace Ycstar\Sfopenic;

use GuzzleHttp\Client;
use Ycstar\Sfopenic\Exceptions\InvalidResponseException;

class Base
{
    protected $host;

    protected $dev_id;

    protected $dev_key;

    protected $guzzleOptions = [];

    protected $options = [];

    public function __construct(string $host, string $dev_id, string $dev_key)
    {
        $this->host = $host;

        $this->dev_id = $dev_id;

        $this->dev_key = $dev_key;
    }

    public function request($method, array $options = [])
    {
        $options['dev_id'] = $this->dev_id;

        $options['push_time'] = time();

        $this->setOptions($options);

        $response = $this->getHttpClient()->post($this->getUrl($method), [
            'query' => [
                'sign' => $this->getSign(json_encode($this->getOptions())),
            ],
            'json' => $this->getOptions()
        ])->getBody()->getContents();

        return json_decode($response, true);
    }

    public function setOptions($options = [])
    {
        $this->options = $options;
    }

    public function getUrl($method)
    {
        return $this->host.'/open/api/external/'.strtolower($method);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getSign($options)
    {
        $signChar  = $options . "&{$this->dev_id}&{$this->dev_key}";

        return base64_encode(MD5($signChar));
    }

    /**
     * 获取回调数据
     * @return json
     */
    public function getNotify()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * 获取回调数据回复内容
     * @return array
     */
    public function getNotifySuccessReply()
    {
        return json_encode(['error_code'=>0,'error_msg'=>'success']);
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
