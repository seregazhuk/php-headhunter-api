<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;

/**
 * Class Suggests
 *
 * @method educationalInstitutions(string $text, string $locale = 'RU')
 * @method companies(string $text, string $locale = 'RU')
 * @method fieldsOfStudy(string $text, string $locale = 'RU')
 * @method skillSet(string $text, string $locale = 'RU')
 * @method positions(string $text, string $locale = 'RU')
 * @method areas(string $text, string $locale = 'RU')
 * @method vacancySearchKeyword(string $text, string $locale = 'RU')
 *
 * @package seregazhuk\HeadHunterApi\EndPoints
 */
class Suggests extends Endpoint
{
    const RESOURCE = 'suggests';

    /**
     * @var array
     */
    protected $suggestions = [
        'educationalInstitutions',
        'companies',
        'fieldsOfStudy',
        'skillSet',
        'positions',
        'areas',
        'vacancySearchKeyword',
    ];

    public function __call($name, $arguments)
    {
        if(!in_array($name, $this->suggestions)) {
            throw new HeadHunterApiException("Suggestion $name not allowed");
        }

        $methodName = $this->resolveSuggestionName($name);

        return $this->getSuggestsFor($methodName, ...$arguments);
    }

    /**
     * @param string $verb
     * @param string $text
     * @param string $locale
     * @return array
     */
    protected function getSuggestsFor($verb, $text, $locale = 'RU')
    {
        return $this->getResource($verb, ['text' => $text, 'locale' => $locale]);
    }

    /**
     * @param $suggestion
     * @return string
     */
    protected function resolveSuggestionName($suggestion)
    {
        return strtolower(preg_replace('([A-Z])', '_$0', $suggestion));
    }
}