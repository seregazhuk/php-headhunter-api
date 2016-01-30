<?php

namespace seregazhuk\HeadHunterApi\Contracts;

interface HttpInterface
{
    /**
     * @param string $uri
     * @param array $params
     * @param null $headers
     * @return array|null
     */
    public function get($uri, $params = [], $headers = null);


    /**
     * @param string $uri
     * @param array $params
     * @param null $headers
     * @return array|null
     */
    public function post($uri, $params = [], $headers = null);

    /**
     * @param string $url
     */
    public function setBaseUrl($url);
}