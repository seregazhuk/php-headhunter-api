<?php

namespace seregazhuk\HeadHunterApi;

use seregazhuk\HeadHunterApi\EndPoints\Artifacts;
use seregazhuk\HeadHunterApi\EndPoints\Comments;
use seregazhuk\HeadHunterApi\EndPoints\Me;
use seregazhuk\HeadHunterApi\EndPoints\Negotiations;
use seregazhuk\HeadHunterApi\EndPoints\Regions;
use seregazhuk\HeadHunterApi\EndPoints\Resumes;
use seregazhuk\HeadHunterApi\EndPoints\SavedSearches;
use seregazhuk\HeadHunterApi\EndPoints\Vacancies;
use seregazhuk\HeadHunterApi\EndPoints\Employers;
use seregazhuk\HeadHunterApi\EndPoints\Industries;
use seregazhuk\HeadHunterApi\EndPoints\Specializations;
use seregazhuk\HeadHunterApi\Adapters\GuzzleHttpAdater;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;

/**
 * Class Api
 * @property Vacancies $vacancies
 * @property Employers $employers
 * @property Regions $regions
 * @property Specializations $specializations
 * @property Industries $industries
 * @property Me $me
 * @property Resumes $resumes
 * @property Artifacts $artifacts
 * @property Negotiations $negotiations
 * @property SavedSearches $saveSearches
 * @property Comments $comments
 */
class Api {

    private $endpointsContainer;

    /**
     * @var Request
     */
    private $request;

    public function __construct($token = null)
    {
        $this->request = new Request(new GuzzleHttpAdater(), $token);
        $this->endpointsContainer = new EndpointsContainer($this->request);
    }

    public function __get($endpoint)
    {
        return $this->endpointsContainer->getEndpoint($endpoint);
    }
}