<?php

namespace seregazhuk\HeadHunterApi\Traits;

use seregazhuk\HeadHunterApi\EndPoints\Me;
use seregazhuk\HeadHunterApi\EndPoints\EndpointsContainer;
use seregazhuk\HeadHunterApi\Exceptions\HeadHunterApiException;
use seregazhuk\HeadHunterApi\Exceptions\WrongEndPointException;

/**
 * Trait ResolvesCurrentUser
 *
 * @property EndpointsContainer $container
 */
trait ResolvesCurrentUser
{
    /**
     * @return array
     * @throws WrongEndPointException
     */
    protected function getCurrentUserInfo()
    {
        /** @var Me $meEndpoint */
        $meEndpoint = $this->container->getEndpoint('me');

        return $meEndpoint->info();
    }

    /**
     * @param string $key
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
     * @throws HeadHunterApiException
     */
    protected function getCurrentEmployerId()
    {
        return $this->getCurrentUserDataId('employer');
    }

    /**
     * @return string
     * @throws HeadHunterApiException
     */
    protected function getCurrentManagerId()
    {
        return $this->getCurrentUserDataId('manager');
    }
}
