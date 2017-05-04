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