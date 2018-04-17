<?php

namespace seregazhuk\HeadHunterApi\Traits;

use UnexpectedValueException;

trait EmployerManagers
{
    use ResolvesCurrentUser;

    /**
     * Reference types and the rights of the Manager
     * @param string|bool $employerId
     * @return array
     */
    public function getManagerTypes($employerId = false)
    {
        $employerId = $this->resolveEmployerId($employerId);

        return $this->getResource("$employerId/manager_types", []);
    }

    /**
     * Get employer managers
     *
     * @param string|bool $employerId default resolved from profile
     * @return array
     */
    public function getManagers($employerId = false)
    {
        $employerId = $this->resolveEmployerId($employerId);

        return $this->getResource("$employerId/managers", []);
    }

    /**
     * Get manager information
     *
     * @param string $managerId
     * @param string|bool $employerId default resolved from profile
     * @return array
     */
    public function getManager($managerId, $employerId = false)
    {
        $employerId = $this->resolveEmployerId($employerId);

        return $this->getResource("$employerId/managers/$managerId", []);
    }

    /**
     * @param string|bool $employerId default resolved from profile
     * @return array
     */
    public function getManagersWhoHasVacancies($employerId = false)
    {
        $managers = $this->getManagers($employerId);

        if(!isset($managers['items']) ) {
            throw new UnexpectedValueException('Failed to get employer managers');
        }

        return array_filter($managers['items'], [$this, 'hasVacancies']);
    }

	/**
	 * @param array $manager
	 * @return bool
	 */
    protected function hasVacancies(array $manager)
    {
        return $manager['vacancies_count'] > 0;
    }

	/**
	 * @param string|bool $employerId
	 * @return string
	 */
    protected function resolveEmployerId($employerId)
    {
        return (false === $employerId)
            ? $this->getCurrentEmployerId()
            : $employerId
        ;
    }
}
