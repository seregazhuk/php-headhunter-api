<?php

namespace seregazhuk\HeadHunterApi\Contracts;

interface RequestInterface
{
    /**
     * @param string $uri
     * @param array $params
     * @return array
     */
    public function get($uri, $params = []);
}