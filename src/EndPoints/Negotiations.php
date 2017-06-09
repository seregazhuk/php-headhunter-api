<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasAll;
use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\InvitedNegotiations;

class Negotiations extends Endpoint
{
    const RESOURCE = 'negotiations';

    use HasView, HasAll, InvitedNegotiations;

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