<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

class Suggests extends Endpoint
{
    const RESOURCE = 'suggests';

    public function educationalInstitutions($text, $locale = 'RU')
    {
        return $this->getSuggestsFor('educational_institutions', $text, $locale);
    }

    public function companies($text, $locale = 'RU')
    {
        return $this->getSuggestsFor('companies', $text, $locale);
    }

    /**
     * @param string $verb
     * @param string $text
     * @param string $locale
     * @return array
     */
    protected function getSuggestsFor($verb, $text, $locale)
    {
        return $this->getResource($verb, ['text' => $text, 'locale' => $locale]);
    }
}