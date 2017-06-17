<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasSimilarVacancies
{
    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract public function getResource($verb = '', array $params = []);

    /**
     * @param string $id
     * @param array $pagination
     * @return mixed
     */
    protected function getSimilarVacanciesFor($id, array $pagination = [])
    {
        return $this->getResource($id . '/similar_vacancies', $pagination);
    }
}