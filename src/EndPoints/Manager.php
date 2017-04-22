<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;

class Manager extends Endpoint
{

    const RESOURCE = '/employers';

    /**
     * @var array
     */
    protected $currentUser;

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
            '{employer_id}/managers/{manager_id}/settings');


        return $this->getResource($uri);
    }

    /**
     * @return null
     * @throws HeadHunterApiException
     */
    protected function getCurrentEmployerId()
    {
        $currentUser = $this->getCurrentUser();

        if(!isset($currentUser['employer']['id'])) {
            throw new HeadHunterApiException('Cannot resolve employer id');
        }

        return $currentUser['employer']['id'];
    }

    protected function getCurrentUser()
    {
        if(!empty($this->currentUser)) return $this->currentUser;

        $this->currentUser = $this->request->get(Me::RESOURCE);

        return $this->currentUser;
    }

    protected function getCurrentManagerId()
    {
        $currentUser = $this->getCurrentUser();

        if(!isset($currentUser['manager']['id'])) {
            throw new HeadHunterApiException('Cannot resolve manager id');
        }

        return $currentUser['manager']['id'];
    }
}