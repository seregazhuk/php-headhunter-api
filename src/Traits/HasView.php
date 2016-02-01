<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasView
{
    abstract function getResource();
    /**
     * @param string $id
     * @return array
     */
    public function view($id)
    {
        return $this->getResource($id);
    }
}