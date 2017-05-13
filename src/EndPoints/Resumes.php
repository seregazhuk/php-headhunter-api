<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\HasSimilarVacancies;

class Resumes extends Endpoint
{
    const RESOURCE = 'resumes';

    use HasView, HasSimilarVacancies;

    public function mine()
    {
        return $this->getResource('mine');
    }

    /**
     * @param string $id
     * @return array
     */
    public function views($id)
    {
        return $this->getResource($id . '/views');
    }

    /**
     * Updates resume publish date
     *
     * @param string $id
     * @return array
     */
    public function publish($id)
    {
        return $this->postResource($id . '/publish');
    }

    /**
     * @param string $id
     * @return array
     */
    public function conditions($id)
    {
        return $this->getResource($id . '/conditions');
    }

    /**
     * @param string $id
     */
    public function delete($id)
    {
        $this->deleteResource($id);
    }

    /**
     * @param $id
     * @param $attributes
     * @return mixed
     */
    public function edit($id, $attributes)
    {
        return $this->putResourceJson($id, $attributes);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->postResourceJson('', $attributes);
    }

    /**
     * @param string $id
     * @return array
     */
    public function status($id)
    {
        return $this->getResource($id . '/status');
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function jobs($id)
    {
        return $this->getSimilarVacanciesFor($id);
    }

    public function negotiations($id)
    {
        return $this->getResource($id . '/negotiations_history');
    }

    public function getWhiteList($id)
    {
        return $this->getResource($id .'/whitelist');
    }

    public function getBlackList($id)
    {
        return $this->getResource($id .'/blacklist');
    }

    /**
     * @param string $resumeId
     * @param string|array $companyId
     * @return mixed
     */
    public function addToWhiteList($resumeId, $companyId)
    {
        return $this->addVisibilityItem($resumeId, $companyId, 'whitelist');
    }

    /**
     * @param string $resumeId
     * @param string|array $companyId
     * @return mixed
     */
    public function addToBlackList($resumeId, $companyId)
    {
        return $this->addVisibilityItem($resumeId, $companyId, 'blacklist');
    }

    /**
     * @param string $resumeId
     * @param string|array $companyId
     * @param string $list
     * @return array
     */
    protected function addVisibilityItem($resumeId, $companyId, $list)
    {
        $companyId = is_array($companyId) ? $companyId : [$companyId];

        $companies = array_map(
            function ($company) {
                return ['id' => (string)$company];
            }, $companyId
        );

        return $this->postResourceJson($resumeId. "/" . $list, ['items' => $companies]);
    }

    /**
     * @param string $resumeId
     * @param null $companyId
     * @return array|null
     */
    public function removeFromWhiteList($resumeId, $companyId = null)
    {
        $params = $companyId ? ['id' => $companyId] : [];

        return $this->deleteResource($resumeId . '/whitelist/employer', $params);
    }

    /**
     * @param string $resumeId
     * @return array|null
     */
    public function clearWhiteList($resumeId)
    {
        return $this->removeFromWhiteList($resumeId);
    }

    /**
     * @param string $resumeId
     * @param null $companyId
     * @return array|null
     */
    public function removeFromBlackList($resumeId, $companyId = null)
    {
        $params = $companyId ? ['id' => $companyId] : [];

        return $this->deleteResource($resumeId . '/blacklist/employer', $params);
    }

    /**
     * @param string $resumeId
     * @return array|null
     */
    public function clearBlackList($resumeId)
    {
        return $this->removeFromBlackList($resumeId);
    }
}