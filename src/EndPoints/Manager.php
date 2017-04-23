<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;

class Manager extends Endpoint
{
    const RESOURCE = '/employers';

    /**
     * Get manager settings
     * @param integer $managerId
     * @return array
     */
    public function preferences($managerId = null)
    {
        $employerId = $this->getCurrentEmployerId();
        $managerId = $managerId ? : $this->getCurrentManagerId();

        $uri = str_replace(
            ['{employer_id}', '{manager_id}'],
            [$employerId, $managerId],
            '{employer_id}/managers/{manager_id}/settings'
        );


        return $this->getResource($uri);
    }

    /**
     * @return null
     * @throws HeadHunterApiException
     */
    protected function getCurrentEmployerId()
    {
        $currentUser = $this->getCurrentUserInfo();

        if(!isset($currentUser['employer']['id'])) {
            throw new HeadHunterApiException('Cannot resolve employer id');
        }

        return $currentUser['employer']['id'];
    }

    protected function getCurrentManagerId()
    {
        $currentUser = $this->getCurrentUserInfo();

        if(!isset($currentUser['manager']['id'])) {
            throw new HeadHunterApiException('Cannot resolve manager id');
        }

        return $currentUser['manager']['id'];
    }

    /**
     * @return array
     */
    protected function getCurrentUserInfo()
    {
        return $this->container->getEndpoint('me')->info();
    }
}