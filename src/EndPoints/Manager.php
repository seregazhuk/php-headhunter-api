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
        $employerId = $this->getCurrentUserDataId('employer');
        $managerId = $managerId ?: $this->getCurrentUserDataId('manager');

        $uri = str_replace(
            ['{employer_id}', '{manager_id}'],
            [$employerId, $managerId],
            '{employer_id}/managers/{manager_id}/settings'
        );

        return $this->getResource($uri);
    }

    /**
     * @param $key
     * @return null
     * @throws HeadHunterApiException
     */
    protected function getCurrentUserDataId($key)
    {
        $currentUser = $this->getCurrentUserInfo();

        if (!isset($currentUser[$key]['id'])) {
            throw new HeadHunterApiException("Cannot resolve $key id");
        }

        return $currentUser[$key]['id'];
    }

    /**
     * @return array
     */
    protected function getCurrentUserInfo()
    {
        /** @var Me $meEndpoint */
        $meEndpoint = $this->container->getEndpoint('me');

        return $meEndpoint->info();
    }
}