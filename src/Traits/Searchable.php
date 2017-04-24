<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait Searchable
{
    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract public function getResource($verb = '', array $params = []);

    /**
     * @param array $queryParams
     * @return array
     */
    public function search($queryParams = [])
    {
        return $this->getResource('', $queryParams);
    }
}