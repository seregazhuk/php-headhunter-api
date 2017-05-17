<?php

namespace seregazhuk\HeadHunterApi\Traits;

use seregazhuk\HeadHunterApi\EndPoints\Me;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;
use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;

/**
 * Trait ResolvesCurrentUser
 *
 * @property EndpointsContainer $container
 */
trait ResolvesCurrentUser
{
    /**
     * @return array
     */
    protected function getCurrentUserInfo()
    {
        /** @var Me $meEndpoint */
        $meEndpoint = $this->container->getEndpoint('me');

        return $meEndpoint->info();
    }

    /**
     * @param $key
     * @return string
     * @throws HeadHunterApiException
     */
    protected function getCurrentUserDataId($key)
    {
        $currentUser = $this->getCurrentUserInfo();

        if (!isset($currentUser[$key]['id'])) {
            throw new HeadHunterApiException("Cannot resolve $key id");
        }

        return $currentUser[$key]['id'];
    }

    /**
     * @return string
     */
    protected function getCurrentEmployerId()
    {
        return $this->getCurrentUserDataId('employer');
    }

    /**
     * @return string
     */
    protected function getCurrentManagerId()
    {
        return $this->getCurrentUserDataId('employer');
    }
}