<?php

namespace seregazhuk\HeadHunterApi\Contracts;

use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;

interface RequestInterface
{
    /**
     * @param string $requestMethod
     * @param string $uri
     * @param array $params
     * @return mixed
     * @throws HeadHunterApiException
     */
    public function makeRequest($requestMethod, $uri, $params = []);

    /**
     * @param string $requestMethod
     * @param string $uri
     * @param array $params
     * @return mixed
     * @throws HeadHunterApiException
     */
    public function makeJsonRequest($requestMethod, $uri, $params = []);
}