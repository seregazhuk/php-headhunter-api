<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;

class Comments extends Endpoint
{
    use HasView;

    const RESOURCE = 'applicant_comments';

    const COMMENT_TYPE_PUBLIC = 'coworkers';
    const COMMENT_TYPE_PRIVATE = 'owner';

    /**
     * @param string $applicantId
     * @param string $text
     * @param string $type
     * @return mixed
     */
    public function create($applicantId, $text, $type = self::COMMENT_TYPE_PUBLIC)
    {
        return $this->postResource($applicantId, ['text' => $text, 'access_type' => $type]);
    }

    /**
     * @param string $applicantId
     * @param string $text
     * @return mixed
     */
    public function createPrivate($applicantId, $text)
    {
        return $this->create($applicantId, $text, self::COMMENT_TYPE_PRIVATE);
    }

    /**
     * @param string $applicantId
     * @param string $commentId
     * @param string $text
     * @param string $type
     * @return mixed
     */
    public function edit($applicantId, $commentId, $text, $type = self::COMMENT_TYPE_PUBLIC)
    {
        return $this->putResource(
            "$applicantId/$commentId",
            ['text' => $text, 'access_type' => $type]
        );
    }

    /**
     * @param string $applicantId
     * @param string $commentId
     * @param string $text
     * @return mixed
     */
    public function editPrivate($applicantId, $commentId, $text)
    {
        return $this->edit($applicantId, $commentId, $text, self::COMMENT_TYPE_PRIVATE);
    }

    /**
     * @param string $applicantId
     * @param string $commentId
     */
    public function delete($applicantId, $commentId)
    {
        $this->deleteResource("$applicantId/$commentId");
    }
}