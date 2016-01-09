<?php

namespace seregazhuk\HeadHunterApi;


use seregazhuk\HeadHunterApi\Contracts\HttpInterface;
use seregazhuk\HeadHunterApi\Contracts\RequestInterface;

class Request implements RequestInterface
{
    const BASE_URL = 'https://api.hh.ru';
    private $client;
    private $token;

    public function __construct(HttpInterface $http, $token = null)
    {
        $http->setBaseUrl(self::BASE_URL);
        $this->client = $http;
        $this->token = $token;
    }

    public function get($uri, $params = [])
    {
        $headers = $this->createHeaders();
        return $this->client->get($uri, $params, $headers);
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