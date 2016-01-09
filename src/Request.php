<?php

namespace seregazhuk\HeadHunterApi;


use seregazhuk\HeadHunterApi\Contracts\HttpInterface;
use seregazhuk\HeadHunterApi\Contracts\RequestInterface;

class Request implements RequestInterface
{
    const BASE_URL = 'https://api.hh.ru';
    private $client;

    public function __construct(HttpInterface $http)
    {
        $http->setBaseUrl(self::BASE_URL);
        $this->client = $http;
    }

    public function get($uri, $params = [])
    {
        return $this->client->get($uri);
    }
}