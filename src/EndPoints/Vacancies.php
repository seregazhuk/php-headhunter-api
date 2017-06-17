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

    public function blacklisted(array $pagination = [])
    {
        return $this->getResource('blacklisted', $pagination);
    }

    /**
     * @param array $pagination
     * @return mixed
     */
    public function favorited(array $pagination = [])
    {
        return $this->getResource('favorited', $pagination);
    }

    /**
     * @param string $id
     * @param array $pagination
     * @return mixed
     */
    public function similar($id, array $pagination = [])
    {
        return $this->getSimilarVacanciesFor($id, $pagination);
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
     * @param array $pagination
     * @return array|null
     */
    public function active($managerId = null, array $pagination = [])
    {
        $managerId = $managerId ?: $this->getCurrentManagerId();

        $params = array_merge(
            $pagination,
            ['manager_id' => $managerId]
        );

        return $this->callEmployersVacanciesEndpoint("active", $params);
    }

    /**
     * @param array $pagination
     * @return array|null
     */
    public function archived(array $pagination = [])
    {
        return $this->callEmployersVacanciesEndpoint("archived", $pagination);
    }

    /**
     * @param array $pagination
     * @return array|null
     */
    public function hidden(array $pagination = [])
    {
        return $this->callEmployersVacanciesEndpoint("hidden", $pagination);
    }

    /**
     * @param string $endpoint
     * @param array $pagination
     * @return array|null
     */
    protected function callEmployersVacanciesEndpoint($endpoint, $pagination = [])
    {
        $employerId = $this->getCurrentEmployerId();

        return $this->request->get("/employers/$employerId/vacancies/$endpoint", $pagination);
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