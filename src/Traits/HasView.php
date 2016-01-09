<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait HasView
{
    /**
     * @param string $id
     * @return array
     */
    public function view($id)
    {
        return $this->getResource($id);
    }
}