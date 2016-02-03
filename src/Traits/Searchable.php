<?php

namespace seregazhuk\HeadHunterApi\Traits;

use seregazhuk\HeadHunterApi\Contracts\RequestInterface;

trait Searchable
{

    abstract public function getResourceUri($uri = '');

    /**
     * @return RequestInterface
     */
    abstract public function getRequest();

    /**
     * @param array $queryParams
     * @return array
     */
    public function search($queryParams = [])
    {
        return $this->getRequest()->get($this->getResourceUri(), $queryParams);
    }
}