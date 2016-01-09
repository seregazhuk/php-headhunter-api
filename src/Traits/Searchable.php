<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait Searchable
{
    /**
     * @param array $queryParams
     * @return array
     */
    public function search($queryParams = [])
    {
        return $this->request->get($this->getResourceUri(), $queryParams);
    }
}