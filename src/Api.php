<?php

namespace seregazhuk\HeadHunterApi;

use seregazhuk\HeadHunterApi\Adapters\GuzzleHttpAdater;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;

class Api
{
    public static function create($token = null)
    {
        $request = new Request(new GuzzleHttpAdater(), $token);
        $endpointsContainer = new EndpointsContainer($request);
        return new Client($endpointsContainer);
    }
}