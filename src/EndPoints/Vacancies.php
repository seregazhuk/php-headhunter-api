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
        $managerId = $managerId ?: $this->getCurrentManagerId();

        return $this->callEmployersVacanciesEndpoint("active", ['manager_id' => $managerId]);
    }

    public function archived()
    {
        return $this->callEmployersVacanciesEndpoint("archived");
    }

    public function hidden()
    {
        return $this->callEmployersVacanciesEndpoint("hidden");
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return array|null
     */
    protected function callEmployersVacanciesEndpoint($endpoint, $params = [])
    {
        $employerId = $this->getCurrentEmployerId();

        return $this->request->get("/employers/$employerId/vacancies/$endpoint", $params);
    }

    /**
     * @param string $id
     * @return array|null
     */
    public function hide($id)
    {
        $employerId = $this->getCurrentEmployerId();

        return $this->request->put("/employers/$employerId/vacancies/hidden/$id");
    }

    /**
     * @param string $id
     * @return array|null
     */
    public function restore($id)
    {
        $employerId = $this->getCurrentEmployerId();

        return $this->request->delete("/employers/$employerId/vacancies/hidden/$id");
    }
}