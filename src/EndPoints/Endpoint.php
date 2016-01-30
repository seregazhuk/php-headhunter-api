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
     * @param string $verb
     * @return array
     */
    protected function getResource($verb = '')
    {
        return $this->request->get($this->getResourceUri($verb));
    }

    protected function postResource($verb = '')
    {
        return $this->request->post($this->getResourceUri($verb));
    }
}