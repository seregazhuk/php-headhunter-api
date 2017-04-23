<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use ReflectionClass;
use seregazhuk\HeadHunterApi\Contracts\RequestInterface;
use seregazhuk\HeadHunterApi\Exceptions\WrongEndPointException;

class EndpointsContainer
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Array with the cached endpoints
     * @var Endpoint[]
     */
    protected $endpoints = [];

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
    protected function addEndpoint($endpoint)
    {
        $class = __NAMESPACE__ . '\\' . ucfirst($endpoint);
        if (!class_exists($class)) {
            throw new WrongEndPointException;
        }

        $this->endpoints[$endpoint] = $this->createEndpoint($class);
    }

    /**
     * @param string $class
     * @return Endpoint|object
     * @throws WrongEndPointException
     */
    protected function createEndpoint($class)
    {
        $reflector = new ReflectionClass($class);
        if(!$reflector->isInstantiable()) {
            throw new WrongEndPointException("Endpoint $class is not instantiable.");
        }

        return $reflector->newInstanceArgs([$this]);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}