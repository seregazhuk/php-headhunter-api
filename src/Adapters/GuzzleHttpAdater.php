<?php

namespace seregazhuk\HeadHunterApi\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use seregazhuk\HeadHunterApi\Contracts\HttpInterface;

class GuzzleHttpAdater implements HttpInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct($baseUrl)
    {
        $this->client = new Client(['base_uri' => $baseUrl]);
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

        $request = new Request('GET', $uri, $headers);

        $response = $this
            ->client
            ->send($request);

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
        $request = new Request('POST', $uri, $headers);

        $response = $this
            ->client
            ->send($request, ['query' => $params]);

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