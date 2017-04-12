<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;

class Comments extends Endpoint
{
    use HasView;

    const RESOURCE = 'applicant_comments';
}