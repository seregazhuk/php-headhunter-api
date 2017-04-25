<?php

namespace seregazhuk\HeadHunterApi;


use seregazhuk\HeadHunterApi\Contracts\HttpInterface;
use seregazhuk\HeadHunterApi\Contracts\RequestInterface;
use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;

class Request implements RequestInterface
{
    /**
     * @var HttpInterface
     */
    protected $client;

    public function __construct(HttpInterface $http, $token = null)
    {
        $this->client = $http;

        if($token) $this->client->setHeaders(['Authorization' => 'Bearer ' . $token]);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = [])
    {
        return $this->client->get($uri, $params);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array
     */
    public function post($uri, $params = [])
    {
        return $this->client->post($uri, $params);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array
     */
    public function put($uri, $params = [])
    {
        return $this->client->put($uri, $params);
    }

    public function delete($uri)
    {
        return $this->client->delete($uri);
    }

    /**
     * @param string $requestMethod
     * @param string $uri
     * @param array $params
     * @param bool $useJson
     * @return mixed
     * @throws HeadHunterApiException
     */
    public function makeRequestCall($requestMethod, $uri, $params = [], $useJson = false)
    {
        $requestMethod = strtolower($requestMethod);

        if(!method_exists($this->client, $requestMethod)) {
            throw new HeadHunterApiException("Request method $requestMethod not found");
        }

        return $this->client->$requestMethod($uri, $params, $useJson);
    }
}