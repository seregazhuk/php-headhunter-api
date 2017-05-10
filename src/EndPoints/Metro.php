<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasAll;

class Metro extends Endpoint
{
    use HasAll;

    const RESOURCE = 'metro';

    /**
     * @param int $cityId
     * @return array
     */
    public function forCity($cityId)
    {
        return $this->getResource($cityId);
    }
}
