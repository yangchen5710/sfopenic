<?php
namespace Ycstar\Sfopenic;

use GuzzleHttp\Client;

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

    public function request($method,array $options = [])
    {   
        $options['dev_id'] = $this->dev_id;

        $options['push_time'] = time();

    	$this->setOptions($options);

    	$response = $this->getHttpClient()->post($this->getUrl($method), [
            'query' => [
                'sign' => $this->getSign($this->getOptions()),
            ],
            'json' => $this->getOptions()
        ])->getBody()->getContents();

        return json_decode($response,true);
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

    public function getSign(array $options)
    {
        $signChar  = json_encode($options) . "&{$this->dev_id}&{$this->dev_key}";

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