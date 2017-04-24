<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasAll
{
    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract public function getResource($verb = '', array $params = []);

    public function all()
    {
        return $this->getResource();
    }
}