<?php

namespace seregazhuk\HeadHunterApi\Contracts;

interface HttpInterface
{
    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = []);

    /**
     * @param string $url
     */
    public function setBaseUrl($url);
}