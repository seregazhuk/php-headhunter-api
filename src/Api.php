<?php

namespace seregazhuk\HeadHunterApi;

use seregazhuk\HeadHunterApi\EndPoints\Employers;
use seregazhuk\HeadHunterApi\EndPoints\Industries;
use seregazhuk\HeadHunterApi\EndPoints\Regions;
use seregazhuk\HeadHunterApi\EndPoints\Specializations;
use seregazhuk\HeadHunterApi\EndPoints\Vacancies;
use seregazhuk\HeadHunterApi\Adapters\GuzzleHttpAdater;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;

/**
 * Class Api
 * @property Vacancies $vacancies
 * @property Employers $employers
 * @property Regions $regions
 * @property Specializations $specializations
 * @property Industries $industries
 */
class Api {

    private $endpointsContainer;

    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->request = new Request(new GuzzleHttpAdater());
        $this->endpointsContainer = new EndpointsContainer($this->request);
    }

    public function __get($endpoint)
    {
        return $this->endpointsContainer->getEndpoint($endpoint);
    }
}