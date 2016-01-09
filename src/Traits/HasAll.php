<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasAll
{
    public function all()
    {
        return $this->getResource();
    }
}