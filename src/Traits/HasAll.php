<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasAll
{
    abstract public function getResource($verb = '');

    public function all()
    {
        return $this->getResource();
    }
}