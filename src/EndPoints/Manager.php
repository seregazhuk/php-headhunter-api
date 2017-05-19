<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\ResolvesCurrentUser;

class Manager extends Endpoint
{
    use ResolvesCurrentUser;

    const RESOURCE = '/employers';

    /**
     * Get manager settings
     * @param integer $managerId
     * @return array
     */
    public function preferences($managerId = null)
    {
        $employerId = $this->getCurrentEmployerId();
        $managerId = $managerId ?: $this->getCurrentManagerId();

        $uri = str_replace(
            ['{employer_id}', '{manager_id}'],
            [$employerId, $managerId],
            '{employer_id}/managers/{manager_id}/settings'
        );

        return $this->getResource($uri);
    }
}