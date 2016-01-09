<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class SavedSearches extends Endpoint
{
    const RESOURCE = 'saved_searches';

    /**
     * @param null|string $id
     * @return array
     */
    public function vacancies($id = null)
    {
        return $this->getResource('vacancies/'.$id);
    }
}