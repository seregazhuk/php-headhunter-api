<?php

namespace seregazhuk\HeadHunterApi\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use seregazhuk\HeadHunterApi\Contracts\HttpInterface;

class GuzzleHttpAdapter implements HttpInterface
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

        return $this->executeRequest('GET', $uri, $headers);
    }

    /**
     * @param string $uri
     * @param array $params
     * @param null $headers
     * @return array|null
     */
    public function post($uri, $params = [], $headers = null)
    {
        return $this->executeRequest('POST', $uri, $headers, $params);
    }

    /**
     * @param string $uri
     * @param null $headers
     * @return array|null
     */
    public function delete($uri, $headers = null)
    {
        return $this->executeRequest('DELETE', $uri, $headers);
    }

    /**
     * @param Response $response
     * @return array|null
     */
    private function parseResponse(Response $response)
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param array $params
     * @return array|null
     */
    protected function executeRequest($method, $uri, array $headers, array $params = [])
    {
        $request = new Request($method, $uri, $headers);

        $response = $this->client->send($request, ['query' => $params]);

        return $this->parseResponse($response);
    }

}