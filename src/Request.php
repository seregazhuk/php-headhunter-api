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

    /**
     * @var null|string
     */
    protected $token;

    public function __construct(HttpInterface $http, $token = null)
    {
        $this->client = $http;
        $this->token = $token;
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = [])
    {
        $headers = $this->createHeaders();

        return $this->client->get($uri, $params, $headers);
    }

    /**
     * @param string $uri
     * @param array $params
     * @return array
     */
    public function post($uri, $params = [])
    {
        $headers = $this->createHeaders();

        return $this->client->post($uri, $params, $headers);
    }

    public function delete($uri)
    {
        $headers = $this->createHeaders();

        return $this->client->delete($uri, $headers);
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
     * @param string $method
     * @param array $params
     * @return array
     * @throws HeadHunterApiException
     */
    public function __call($method, $params)
    {
        if(!preg_match('/send(.+)Request/', $method, $matches)) {
            throw new HeadHunterApiException("Method $method not found");
        };

        return $this->makeRequestCall($matches[1], $params);
    }

    /**
     * @param string $requestMethod
     * @param array $params
     * @return mixed
     */
    protected function makeRequestCall($requestMethod, $params)
    {
        $requestMethod = strtolower($requestMethod);

        $params['headers'] = $this->createHeaders();

        return $this->client->$requestMethod(...$params);
    }
}