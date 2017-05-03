<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Me extends Endpoint
{
    const RESOURCE = 'me';

    /**
     * @return array
     */
    public function info()
    {
        return $this->getResource();
    }

    /**
     * @param bool $val
     */
    public function setIsInSearch($val = true)
    {
        $this->postResource('', ['is_in_search' => $val]);
    }

    /**
     * @param string $lastName
     * @param string $firstName
     * @param string $middleName
     * @return mixed
     */
    public function editName($lastName, $firstName, $middleName)
    {
        $data = [
            'last_name'   => $lastName,
            'first_name'  => $firstName,
            'middle_name' => $middleName
        ];

        return $this->postResource('', $data);
    }
}
