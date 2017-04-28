<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Request;

abstract class Endpoint
{
    const RESOURCE = '/resource';

    /**
     * @var EndpointsContainer
     */
    protected $container;

    /**
     * @param EndpointsContainer $container
     */
    public function __construct(EndpointsContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $verb
     * @param array $params
     * @return array
     */
    protected function getResource($verb = '', array $params = [])
    {
        return $this->requestResource('get', $verb, $params);
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
     * @param array $params
     * @return mixed
     */
    protected function postResourceJson($verb = '', array $params = [])
    {
        return $this->requestResourceJson('post', $verb, $params);
    }


    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    protected function putResource($verb = '', array $params = [])
    {
        return $this->requestResource('put', $verb, $params);
    }

    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    protected function putResourceJson($verb = '', array $params = [])
    {
        return $this->requestResourceJson('put', $verb, $params);
    }

    /**
     * @param string $verb
     */
    protected function deleteResource($verb = '')
    {
        $this->requestResource('delete', $verb);
    }

    /**
     * @param string $method
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    protected function requestResource($method = 'get', $verb = '', $params = [])
    {
        $method = strtolower($method);

        return $this->callRequestMethod($method, $verb, $params);
    }

    /**
     * @param string $method
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    protected function requestResourceJson($method = 'get', $verb = '', $params = [])
    {
        return $this->requestResource($method. 'Json', $verb, $params);
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
     * @return Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $method
     * @param $verb
     * @param $params
     * @return mixed
     */
    protected function callRequestMethod($method, $verb, $params)
    {
        $request = $this->container->getRequest();

        return $request->$method(
            $this->getResourceUri($verb), $params
        );
    }
}