<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Contracts\RequestInterface;

abstract class Endpoint
{
    const RESOURCE = '/resource';

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $uri
     * @return string
     */
    protected function getResourceUri($uri = '')
    {
        $resource = static::RESOURCE;
        return empty($uri) ? $resource : $resource . sprintf('/%s', $uri);
    }

    /**
     * @param array $queryParams
     * @return array
     */
    public function search($queryParams = [])
    {
        return $this->request->get($this->getResourceUri(), $queryParams);
    }
}