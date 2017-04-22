<?php

namespace seregazhuk\HeadHunterApi;

use seregazhuk\HeadHunterApi\EndPoints\Me;
use seregazhuk\HeadHunterApi\EndPoints\Manager;
use seregazhuk\HeadHunterApi\EndPoints\Regions;
use seregazhuk\HeadHunterApi\EndPoints\Resumes;
use seregazhuk\HeadHunterApi\EndPoints\Comments;
use seregazhuk\HeadHunterApi\EndPoints\Artifacts;
use seregazhuk\HeadHunterApi\EndPoints\Vacancies;
use seregazhuk\HeadHunterApi\EndPoints\Employers;
use seregazhuk\HeadHunterApi\EndPoints\Industries;
use seregazhuk\HeadHunterApi\EndPoints\Negotiations;
use seregazhuk\HeadHunterApi\EndPoints\SavedSearches;
use seregazhuk\HeadHunterApi\EndPoints\Specializations;
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
 * @property SavedSearches $savedSearches
 * @property Comments $comments
 * @property Manager $manager
 */
class Client {

    private $endpointsContainer;

    public function __construct(EndpointsContainer $endpointsContainer)
    {
        $this->endpointsContainer = $endpointsContainer;
    }

    public function __get($endpoint)
    {
        return $this->endpointsContainer->getEndpoint($endpoint);
    }
}