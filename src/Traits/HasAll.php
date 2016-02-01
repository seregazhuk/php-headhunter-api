<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasAll
{
    abstract function getResource($verb = '');

    public function all()
    {
        return $this->getResource();
    }
}