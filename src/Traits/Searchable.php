<?php

namespace seregazhuk\HeadHunterApi\Traits;

use seregazhuk\HeadHunterApi\Contracts\RequestInterface;

trait Searchable
{
    /**
     * @var RequestInterface
     */
    protected $request;

    abstract function getResourceUri();
    /**
     * @param array $queryParams
     * @return array
     */
    public function search($queryParams = [])
    {
        return $this->request->get($this->getResourceUri(), $queryParams);
    }
}