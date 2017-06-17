<?php

namespace seregazhuk\HeadHunterApi\Traits;

trait InvitedNegotiations
{
    /**
     * @param string $verb
     * @param array $params
     * @return mixed
     */
    abstract public function getResource($verb = '', array $params = []);

    /**
     * @param int $vacancyId
     * @param string $status
     * @param array $pagination
     * @return mixed
     */
    public function invited($vacancyId, $status = '', array $pagination = [])
    {
        $params = array_merge(
            $pagination,
            ['vacancy_id' => $vacancyId]
        );

        return $this->getResource($status, $params);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedResponses($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'response', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedConsider($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'consider', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedPhoneInterviews($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'phone_interview', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedAssessments($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'assessment', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedInterviews($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'interview', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedOffers($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'offer', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedHired($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'hired', $pagination);
    }

    /**
     * @param int $vacancyId
     * @param array $pagination
     * @return mixed
     */
    public function invitedDiscardByEmployer($vacancyId, array $pagination = [])
    {
        return $this->invited($vacancyId, 'discard_by_employer', $pagination);
    }
}