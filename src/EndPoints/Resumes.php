<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\Searchable;

class Resumes extends Endpoint
{
    const RESOURCE = 'resumes';

    use HasView;

    public function mine()
    {
        return $this->getResource('mine');
    }

    /**
     * @param string $id
     * @return array
     */
    public function views($id)
    {
        return $this->getResource($id . '/views');
    }

    /**
     * Updates resume publish date
     *
     * @param string $id
     * @return array
     */
    public function publish($id)
    {
        return $this->postResource($id . '/publish');
    }

    /**
     * @param string $id
     * @return array
     */
    public function conditions($id)
    {
        return $this->getResource($id . '/conditions');
    }

    /**
     * @param string $id
     */
    public function delete($id)
    {
        $this->deleteResource($id);
    }

    /**
     * @param string $id
     * @return array
     */
    public function status($id)
    {
        return $this->getResource($id . '/status');
    }

    public function jobs($id)
    {
        return $this->getResource($id . '/similar_vacancies');
    }

    public function negotiations($id)
    {
        return $this->getResource($id . '/negotiations_history');
    }
}