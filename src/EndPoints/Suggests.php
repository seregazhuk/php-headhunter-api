<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Suggests extends Endpoint
{
    const RESOURCE = 'suggests';

    public function educationalInstitutions($text, $locale = 'RU')
    {
        return $this->getResource('educational_institutions', ['text' => $text, 'locale' => $locale]);
    }
}