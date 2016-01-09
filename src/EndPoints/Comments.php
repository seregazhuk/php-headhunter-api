<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasView;

class Comments extends Endpoint
{
    const RESOURCE = 'applicant_comments';

    use HasView;
}