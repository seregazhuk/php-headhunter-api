<?php

namespace seregazhuk\HeadHunterApi\EndPoints;

use seregazhuk\HeadHunterApi\Traits\HasAll;
use seregazhuk\HeadHunterApi\Traits\HasView;

class SavedSearches extends Endpoint
{
    const RESOURCE = 'saved_searches/vacancies';

    use HasAll, HasView;
}