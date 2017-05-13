<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\HasVisibilityList;
use seregazhuk\HeadHunterApi\Traits\HasSimilarVacancies;

class Resumes extends Endpoint
{
    const RESOURCE = 'resumes';

    use HasView, HasSimilarVacancies, HasVisibilityList;

    /**
     * @return array
     */
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
     * @param array $attributes
     * @return mixed
     */
    public function edit($id, $attributes)
    {
        return $this->putResourceJson($id, $attributes);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->postResourceJson('', $attributes);
    }

    /**
     * @param string $id
     * @return array
     */
    public function status($id)
    {
        return $this->getResource($id . '/status');
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function jobs($id)
    {
        return $this->getSimilarVacanciesFor($id);
    }

    /**
     * @param string $id
     * @return array
     */
    public function negotiations($id)
    {
        return $this->getResource($id . '/negotiations_history');
    }
}