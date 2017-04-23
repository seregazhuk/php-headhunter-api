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

    protected function requestResource($method = 'get', $verb = '', $params = [])
    {
        $method = strtolower($method);

        return $this->request->makeRequestCall($method, $this->getResourceUri($verb), $params);
    }

    /**
     * @param string $verb
     * @return array
     */
    protected function getResource($verb = '')
    {
        return $this->requestResource('get', $verb);
    }

    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    protected function postResource($verb = '', array $params = [])
    {
        return $this->requestResource('post', $verb, $params);
    }

    /**
     * @param string $verb
     */
    protected function deleteResource($verb = '')
    {
        $this->requestResource('delete', $verb);
    }

    /**
     * @return RequestInterface
     */
    protected function getRequest()
    {
        return $this->request;
    }
}