<?php

namespace seregazhuk\HeadHunterApi\Adapters;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
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
     * @param string $url
     */
    public function setBaseUrl($url)
    {
        $this->client->setBaseUrl($url);
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

        $response = $this->client->get($uri, $headers)
            ->send();
        return $this->parseResponse($response);
    }

    /**
     * @param string $uri
     * @param array $params
     * @param null $headers
     * @return array|null
     */
    public function post($uri, $params = [], $headers = null)
    {
        $response = $this->client->post($uri, $headers, $params)
            ->send();
        return $this->parseResponse($response);
    }

    /**
     * @param Response $response
     * @return array|null
     */
    private function parseResponse(Response $response)
    {
        return json_decode($response->getBody(), true);
    }

}