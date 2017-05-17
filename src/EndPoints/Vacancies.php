<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\ResolvesCurrentUser;
use seregazhuk\HeadHunterApi\Traits\Searchable;
use seregazhuk\HeadHunterApi\Traits\HasSimilarVacancies;

class Vacancies extends Endpoint
{
    const RESOURCE = 'vacancies';

    use HasView, Searchable, HasSimilarVacancies, ResolvesCurrentUser;

    public function blacklisted()
    {
        return $this->getResource('blacklisted');
    }

    public function favorited()
    {
        return $this->getResource('favorited');
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function similar($id)
    {
        return $this->getSimilarVacanciesFor($id);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function statistics($id)
    {
        return $this->getResource($id . '/stats');
    }

    /**
     * @param string|null $managerId
     * @return array|null
     */
    public function active($managerId = null)
    {
        $employerId = $this->getCurrentEmployerId();
        $managerId = $managerId ?: $this->getCurrentManagerId();

        return $this->request->get(
            "/employers/$employerId/vacancies/active",
            ['manager' => $managerId]
        );
    }
}