<?php

namespace seregazhuk\HeadHunterApi\Traits;

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

        $verb = sprintf("%s/manager_types", $employerId );

        return $this->getResource($verb, []);
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

        $verb = sprintf("%s/managers", $employerId);

        return $this->getResource($verb, []);
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

        $verb = sprintf("%s/managers/%s", $employerId, $managerId );

        return $this->getResource($verb, []);
    }

    /**
     * @param string|bool $employerId default resolved from profile
     * @return array
     */
    public function getManagersWhoHasVacancies($employerId = false)
    {
        $managers = $this->getManagers($employerId);

        if(!isset($managers['items']) ) {
            throw new \UnexpectedValueException("Failed to get employer managers");
        }

        return array_filter($managers['items'], [$this, 'hasVacancies']);
    }

	/**
	 * @param array $manager
	 * @return bool
	 */
    protected function hasVacancies(array $manager)
    {
        return isset($manager) && $manager['vacancies_count'] > 0;
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
