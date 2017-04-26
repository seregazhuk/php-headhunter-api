<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\Searchable;

class Vacancies extends Endpoint
{
    const RESOURCE = 'vacancies';

    use HasView, Searchable;

    public function blacklisted()
    {
        return $this->getResource('blacklisted');
    }

    public function favorited()
    {
        return $this->getResource('favorited');
    }
}