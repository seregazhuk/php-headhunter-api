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
     * @param string $requestMethod
     * @param string $uri
     * @param array $params
     * @param bool $useJson
     * @return mixed
     * @throws HeadHunterApiException
     */
    public function makeRequest($requestMethod, $uri, $params = [], $useJson = false)
    {
        $requestMethod = strtolower($requestMethod);

        return $this->executeRequest($requestMethod, $uri, $params);
    }

    /**
     * @param string $requestMethod
     * @param string $uri
     * @param array $params
     * @return mixed
     * @throws HeadHunterApiException
     */
    public function makeJsonRequest($requestMethod, $uri, $params = [])
    {
        $requestMethod = strtolower($requestMethod) . 'json';

        return $this->executeRequest($requestMethod, $uri, $params);
    }

    /**
     * @param $requestMethod
     * @param $uri
     * @param array $params
     * @return mixed
     * @throws HeadHunterApiException
     */
    protected function executeRequest($requestMethod, $uri, array $params = [])
    {
        if(!method_exists($this->client, $requestMethod)) {
            throw new HeadHunterApiException("Request method $requestMethod not found");
        }

        return $this->client->$requestMethod($uri, $params);
    }
}