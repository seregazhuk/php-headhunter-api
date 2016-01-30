# HeadHunter.ru api library (in process)

[![Build Status](https://travis-ci.org/seregazhuk/php-headhunter-api.svg)](https://travis-ci.org/seregazhuk/php-headhunter-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/?branch=master)

Provides query api interface for HeadHunter (hh.ru) service. 
Additional api docs available [here] (https://github.com/hhru/api).

## Installation

Via composer:
```
composer require seregazhuk/headhunter-api
```

## Quick Start

```php 
// You may need to amend this path to locate composer's autoloader
require('vendor/autoload.php'); 
use seregazhuk\HeadHunterApi\Api;

/**
* Token is optional . Your need token only 
* for resources that require authentication
*/
$api = new Api::create('YOUR_TOKEN');
$userInfo = $api->me->info();
```

## API Resources

### Vacancies
Get black listed vacancies:
```php 
$api->vacancies->blacklisted(); 
```

View vacancy by id:
```php 
$vacancy = $api->vacancies->view($id); 
```

Search:
```php 
$vacancies = $api->vacancies->search($params); 
```

### Employers

View employee by id:
```php 
$employee = $api->employers->view($id); 
```

Search:
```php 
$employers = $api->employers->search($params); 
```

### Artifacts:

Photo:
```php 
$photo = $api->artifacts->photo(); 
```

Portfolio:
```php 
$portfolio = $api->artifacts->portfolio(); 
```

### Applicant comments

Get all comments about applicant:
```php 
$comments = $api->comments->view($applicantId); 
```

### Industries

Get all industries:
```php 
$industries = $api->industries->all(); 
```

### Negotiations

Get all negotiations:
```php 
$negotiations = $api->negotiations->all(); 
```

Get only active negotiations:
```php 
$negotiations = $api->negotiations->active(); 
```

Get messages of negotiation:
```php 
$messages = $api->negotiations->messages($negotiationId); 
```

### Regions

Get all regions:
```php 
$regions = $api->regions->all(); 
```

### Resumes

Get my resumes:
```php 
$resumes = $api->resumes->mine(); 
```

Search:
```php 
$resumes = $api->resumes->search($params); 
```

Resume views:
```php 
$views = $api->resumes->view($resumeId); 
```

Views history:
```php 
$history = $api->resumes->history($resumeId); 
```

Update resume publish date:
```php 
$api->resumes->publish($resumeId); 
```

Get resume conditions:
```php 
$conditions = $api->resumes->conditions($resumeId); 
```

### Saved searches:

List searches:
```php 
$searches = $api->savedSearches->all(); 
```

Get one search:
```php 
$searches = $api->savedSearches->view($searchId); 
```

### Specializations

Get all specializations:
```php 
$specializations = $api->specializations->all(); 
```
