<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasView
{
    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract public function getResource($verb = '', array $params = []);

    /**
     * @param string $id
     * @return array
     */
    public function view($id)
    {
        return $this->getResource($id);
    }
}