<?php

namespace seregazhuk\HeadHunterApi;

use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;

class Api
{
    /**
     * @param string|null $token
     * @return EndpointsContainer
     */
    public static function create($token = null)
    {
        $request = new Request($token);

        return new EndpointsContainer($request);
    }

    private function __clone()
    {
    }

    private function __construct()
    {
    }
}