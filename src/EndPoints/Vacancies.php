<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Vacancies extends Endpoint
{
    const RESOURCE = 'vacancies';

    /**
     * @param int $vacancyId
     * @return array
     */
    public function view($vacancyId)
    {
        return $this->request->get(self::RESOURCE . $vacancyId);
    }
}