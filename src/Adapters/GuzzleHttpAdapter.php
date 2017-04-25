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

    /**
     * @var
     */
    protected $headers;

    public function __construct($baseUrl)
    {
        $this->client = new Client(['base_uri' => $baseUrl]);
    }

    /**
     * @param mixed $headers
     * @return GuzzleHttpAdapter
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return array|null
     */
    protected function createHeaders()
    {
        $headers = null;

        if(isset($this->token)) $headers['Authorization'] = 'Bearer ' . $this->token;

        return $headers;
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = [])
    {
        if(!empty($params)){
            $uri .= '?'. http_build_query($params);
        }

        return $this->executeRequest('GET', $uri);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function post($uri, $params = [])
    {
        return $this->executeRequest('POST', $uri, ['query' => $params]);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function postJson($uri, $params = [])
    {
        return $this->executeRequest('POST', $uri, ['json' => $params]);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function put($uri, $params = [])
    {
        return $this->executeRequest('PUT', $uri, ['json' => $params]);
    }

    /**
     * @param string $uri
     * @param null $headers
     * @return array|null
     */
    public function delete($uri, $headers = null)
    {
        return $this->executeRequest('DELETE', $uri);
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
     * @param array $options
     * @return array|null
     */
    protected function executeRequest($method, $uri, array $options = [])
    {
        $request = new Request($method, $uri, $this->headers);

        $response = $this->client->send($request, $options);

        return $this->parseResponse($response);
    }
}