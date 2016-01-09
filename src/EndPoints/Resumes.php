<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\Searchable;

class Resumes extends Endpoint
{
    const RESOURCE = 'resumes';

    use HasView, Searchable;

    public function mine()
    {
        return $this->getResource('mine');
    }

    /**
     * @param string $id
     * @return array
     */
    public function history($id)
    {
        return $this->getResource($id . '/views');
    }
}