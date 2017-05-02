<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasAll;
use seregazhuk\HeadHunterApi\Traits\HasView;

class Negotiations extends Endpoint
{
    const RESOURCE = 'negotiations';

    use HasView, HasAll;

    public function active()
    {
        return $this->getResource('active');
    }

    /**
     * @param string $id
     * @return array
     */
    public function messages($id)
    {
        return $this->getResource($id . '/messages');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invited($vacancyId)
    {
        return $this->getResource('', ['vacancy_id' => $vacancyId]);
    }

    public function view($negotiationId)
    {
        return $this->getResource($negotiationId);
    }

    /**
     * @param int $id
     * @param string $message
     * @return mixed
     */
    public function message($id, $message)
    {
        return $this->postResource($id, ['message' => $message]);
    }
}