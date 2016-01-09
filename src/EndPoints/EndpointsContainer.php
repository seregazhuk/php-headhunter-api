<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Contracts\RequestInterface;
use seregazhuk\HeadHunterApi\Exceptions\WrongEndPointException;

class EndpointsContainer
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Array with the cached endpoints
     * @var Endpoint[]
     */
    private $endpoints = [];

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $endpoint
     * @return Endpoint
     * @throws WrongEndPointException
     */
    public function getEndpoint($endpoint)
    {
        if (!isset($this->endpoints[$endpoint])) {
            $this->addEndpoint($endpoint);
        }

        return $this->endpoints[$endpoint];
    }

    /**
     * @param string $endpoint
     * @throws WrongEndPointException
     */
    private function addEndpoint($endpoint)
    {
        $class = __NAMESPACE__ . '\\' . ucfirst($endpoint);
        if (!class_exists($class)) {
            throw new WrongEndPointException;
        }

        $obj = new $class($this->request);
        $this->endpoints[$endpoint] = $obj;
    }
}