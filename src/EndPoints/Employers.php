<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\EmployerManagers;
use seregazhuk\HeadHunterApi\Traits\HasView;
use seregazhuk\HeadHunterApi\Traits\Searchable;

class Employers extends Endpoint
{
    use Searchable, HasView, EmployerManagers;

    const RESOURCE = 'employers';
}
