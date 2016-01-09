<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Me extends Endpoint
{
    const RESOURCE = 'me';

    public function info()
    {
        return $this->request->get(self::RESOURCE);
    }
}