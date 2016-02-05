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

    /**
     * @param string $lastName
     * @param string $firstName
     * @param string $middleName
     */ 
    public function editName($lastName, $firstName, $middleName)
    {
        $data = [
            'last_name'   => $lastName,
            'first_name'  => $firstName,
            'middle_name' => $middleName
        ];
        $this->request->post(self::RESOURCE, $data);
    }

}
