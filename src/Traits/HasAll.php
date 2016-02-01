<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasAll
{
    abstract function getResource();

    public function all()
    {
        return $this->getResource();
    }
}