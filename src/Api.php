<?php

namespace seregazhuk\HeadHunterApi;

use seregazhuk\HeadHunterApi\Adapters\GuzzleHttpAdater;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;

class Api
{
    const BASE_URL = 'https://api.hh.ru/';

    /**
     * @param string|null $token
     * @return Client
     */
    public static function create($token = null)
    {
        $request = new Request(new GuzzleHttpAdater(self::BASE_URL), $token);

        $endpointsContainer = new EndpointsContainer($request);

        return new Client($endpointsContainer);
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}