<?php

namespace seregazhuk\HeadHunterApi;


use seregazhuk\HeadHunterApi\Contracts\HttpInterface;
use seregazhuk\HeadHunterApi\Contracts\RequestInterface;

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
}