<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasAll;

class Faculties extends Endpoint
{
    use HasAll;

    const RESOURCE = 'educational_institutions';

    /**
     * @param int $institutionId
     * @return mixed
     */
    public function forInstitution($institutionId)
    {
        return $this->getResource($institutionId . '/faculties');
    }
}
