<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Artifacts extends Endpoint
{
    const RESOURCE = 'artifacts';

    public function photo()
    {
        return $this->getResource('photo');
    }

    public function portfolio()
    {
        return $this->getResource('portfolio');
    }
}