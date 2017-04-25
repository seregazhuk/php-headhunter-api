<?php

namespace seregazhuk\HeadHunterApi\Contracts;

use seregazhuk\HeadHunterApi\Adapters\GuzzleHttpAdapter;

interface HttpInterface
{
    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function get($uri, $params = []);

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function post($uri, $params = []);

    /**
     * @param string $uri
     * @return array|null
     */
    public function delete($uri);

    /**
     * @param string $uri
     * @param array $params
     * @return array|null
     */
    public function put($uri, $params = []);

    /**
     * @param mixed $headers
     * @return GuzzleHttpAdapter
     */
    public function setHeaders($headers);
}