<?php

namespace seregazhuk\HeadHunterApi\Adapters;

use Guzzle\Http\Client;
use seregazhuk\HeadHunterApi\Contracts\HttpInterface;

class GuzzleHttpAdater implements HttpInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $uri
     * @param array $params
     * @param null $headers
     * @return array|null
     */
    public function get($uri, $params = [], $headers = null)
    {
        if(!empty($params)){
            $uri .= '?'. http_build_query($params);
        }

        $request = $this->client->get($uri, $headers);
        $response = $request->send();
        return json_decode($response->getBody(), true);
    }

    public function setBaseUrl($url)
    {
        $this->client->setBaseUrl($url);
    }
}