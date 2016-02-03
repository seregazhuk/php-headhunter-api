<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasView
{
    abstract public function getResource($verb = '');
    /**
     * @param string $id
     * @return array
     */
    public function view($id)
    {
        return $this->getResource($id);
    }
}