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
     * @return mixed
     */
    public function invited($vacancyId, $status = '')
    {
        return $this->getResource($status, ['vacancy_id' => $vacancyId]);
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedResponses($vacancyId)
    {
        return $this->invited($vacancyId, 'response');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedConsider($vacancyId)
    {
        return $this->invited($vacancyId, 'consider');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedPhoneInterviews($vacancyId)
    {
        return $this->invited($vacancyId, 'phone_interview');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedAssessments($vacancyId)
    {
        return $this->invited($vacancyId, 'assessment');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedInterviews($vacancyId)
    {
        return $this->invited($vacancyId, 'interview');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedOffers($vacancyId)
    {
        return $this->invited($vacancyId, 'offer');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedHired($vacancyId)
    {
        return $this->invited($vacancyId, 'hired');
    }

    /**
     * @param int $vacancyId
     * @return mixed
     */
    public function invitedDiscardByEmployer($vacancyId)
    {
        return $this->invited($vacancyId, 'discard_by_employer');
    }
}