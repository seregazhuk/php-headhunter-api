<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Me extends Endpoint
{
    const RESOURCE = 'me';

    public function info()
    {
        return $this->request->get(self::RESOURCE);
    }

    /**
     * @param bool $val
     */
    public function inSearch($val = true)
    {
        $this->request->post(self::RESOURCE, ['is_in_search'=>$val]);
    }
}