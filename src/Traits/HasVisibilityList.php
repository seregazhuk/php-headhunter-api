<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasVisibilityList
{
    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract public function getResource($verb = '', array $params = []);

    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract protected function postResourceJson($verb = '', array $params = []);

    /**
     * @param string $verb
     * @param array $params
     * @return array|null
     */
    abstract protected function deleteResource($verb = '', $params = []);

    /**
     * @param string $id
     * @return array
     */
    public function getWhiteList($id)
    {
        return $this->getResource($id .'/whitelist');
    }

    /**
     * @param string $id
     * @return array
     */
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
     * @param string $companyId
     * @return array|null
     */
    public function removeFromWhiteList($resumeId, $companyId)
    {
        return $this->deleteResource(
            $resumeId . '/whitelist/employer',
            ['id' => $companyId]
        );
    }

    /**
     * @param string $resumeId
     * @return array|null
     */
    public function clearWhiteList($resumeId)
    {
        return $this->deleteResource($resumeId . '/whitelist/');
    }

    /**
     * @param string $resumeId
     * @param string $companyId
     * @return array|null
     */
    public function removeFromBlackList($resumeId, $companyId)
    {
        return $this->deleteResource(
            $resumeId . '/blacklist/employer',
            ['id' => $companyId]
        );
    }

    /**
     * @param string $resumeId
     * @return array|null
     */
    public function clearBlackList($resumeId)
    {
        return $this->delete($resumeId . '/blacklist/');
    }

    /**
     * @param string $resumeId
     * @param string $text
     * @return mixed
     */
    public function searchInBlackList($resumeId, $text)
    {
        return $this->searchInList($resumeId, 'blacklist', $text);
    }

    /**
     * @param string $resumeId
     * @param string $text
     * @return mixed
     */
    public function searchInWhiteList($resumeId, $text)
    {
        return $this->searchInList($resumeId, 'whitelist', $text);
    }

    /**
     * @param string $resumeId
     * @param string $text
     * @param string $type
     * @return mixed
     */
    protected function searchInList($resumeId, $type, $text)
    {
        return $this->getResource($resumeId . "/$type/search", ['text' => $text]);
    }
}