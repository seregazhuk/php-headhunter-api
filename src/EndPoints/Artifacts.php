<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Artifacts extends Endpoint
{
    const RESOURCE = 'artifacts';

    public function photos()
    {
        return $this->getResource('photo');
    }

    public function portfolio()
    {
        return $this->getResource('portfolio');
    }

    public function editPhoto($id, $attributes)
    {
        return $this->putResource($id, $attributes);
    }

    public function deletePhoto($id)
    {
        $this->deleteResource($id);
    }

    /**
     * @param string $file
     * @param string $description
     * @return array|null
     */
    public function uploadPhoto($file, $description = '')
    {
        return $this->upload('photo', $file, $description);
    }

    /**
     * @param string $file
     * @param string $description
     * @return array|null
     */
    public function uploadPortfolio($file, $description = '')
    {
        return $this->upload('portfolio', $file, $description);
    }

    /**
     * @param string $type
     * @param string $description
     * @param string $file
     * @return array|null
     */
    public function upload($type, $file, $description = '')
    {
        $data = [
            [
                'name' => 'type',
                'contents' => $type,
            ],
            [
                'name' => 'description',
                'contents' => $description,
            ],
            [
                'name' => 'file',
                'contents' => fopen($file, 'r'),
            ],
        ];

        return $this->postResourceFile('', $data);
    }
}