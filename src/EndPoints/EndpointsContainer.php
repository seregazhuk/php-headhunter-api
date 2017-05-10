<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Request;
use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;
use seregazhuk\HeadHunterApi\Exceptions\WrongEndPointException;

/**
 * Class EndpointsContainer
 * @package seregazhuk\HeadHunterApi\EndPoints
 *
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
 * @property Dictionaries $dictionaries
 * @property Suggests $suggests
 * @property Metro $metro
 * @property Auth $auth
 * @property Languages $languages
 * @property Faculties $faculties
 *
 * @method $this setLocale(string $locale)
 * @method $this setHost(string $host)
 */
class EndpointsContainer
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Array with the cached endpoints
     * @var Endpoint[]
     */
    protected $endpoints = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $endpoint
     * @return Endpoint
     */
    public function __get($endpoint)
    {
        return $this->getEndpoint($endpoint);
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return EndpointsContainer
     * @throws HeadHunterApiException
     */
    public function __call($method, $arguments)
    {
        if($this->isRequestSetter($method)) {
            return $this->callRequestSetter($method, $arguments);
        }

        throw new HeadHunterApiException("Method $method not found");
    }

    /**
     * @param string $endpoint
     * @return Endpoint
     * @throws WrongEndPointException
     */
    public function getEndpoint($endpoint)
    {
        if (!isset($this->endpoints[$endpoint])) {
            $this->addEndpoint($endpoint);
        }

        return $this->endpoints[$endpoint];
    }

    /**
     * @param string $endpoint
     * @throws WrongEndPointException
     */
    protected function addEndpoint($endpoint)
    {
        $class = __NAMESPACE__ . '\\' . ucfirst($endpoint);

        if (!$this->checkIsEndpoint($class)) {
            throw new WrongEndPointException("$endpoint is not a valid endpoint");
        }

        $this->endpoints[$endpoint] = new $class($this);
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return $this
     */
    protected function callRequestSetter($method, $arguments)
    {
        $this->request->$method(... $arguments);

        return $this;
    }

    /**
     * @param string $method
     * @return bool
     */
    protected function isRequestSetter($method)
    {
        return strpos($method, 'set') === 0 && method_exists($this->request, $method);
    }

    /**
     * @param string $class
     * @return bool
     */
    protected function checkIsEndpoint($class)
    {
        if(!class_exists($class)) return false;

        return in_array(Endpoint::class, class_parents($class));
    }
}