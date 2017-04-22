# HeadHunter.ru api library (in process)

[![Code Climate](https://codeclimate.com/github/seregazhuk/php-headhunter-api/badges/gpa.svg)](https://codeclimate.com/github/seregazhuk/php-headhunter-api)
[![Test Coverage](https://codeclimate.com/github/seregazhuk/php-headhunter-api/badges/coverage.svg)](https://codeclimate.com/github/seregazhuk/php-headhunter-api/coverage)
[![Build Status](https://travis-ci.org/seregazhuk/php-headhunter-api.svg)](https://travis-ci.org/seregazhuk/php-headhunter-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/?branch=master)
[![Circle CI](https://circleci.com/gh/seregazhuk/php-headhunter-api.svg?style=shield)](https://circleci.com/gh/seregazhuk/php-headhunter-api)
[![Latest Stable Version](https://poser.pugx.org/seregazhuk/headhunter-api/v/stable)](https://packagist.org/packages/seregazhuk/headhunter-api)
[![Total Downloads](https://poser.pugx.org/seregazhuk/headhunter-api/downloads)](https://packagist.org/packages/seregazhuk/headhunter-api)

Provides friendly api interface for HeadHunter (hh.ru) service.
Additional api docs available [here](https://github.com/hhru/api).

## Dependencies

Requires PHP 5.5 or above.


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
$api = Api::create('YOUR_TOKEN');
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

### User:

Get user info:
```php
$info = $api->me->info();
```

Update flag 'is_in_search':
```php
$isInSearch = TRUE; // or FALSE;
$api->me->inSearch($isInSearch);
```

Update name(last, first, middle). All params are required:
```php
$api->me->editName($lastName, $firstName, $middleName);
```

Manager preferences by managerId. You can get your manager id from user object, returned from `$api->me->info()`.
When used without parameters your manager id will be automatically resolved from your profile.

```php
$me = $api->me->info();
$managerId = $me['manager']['id'];
$preferences = $api->manager->preferences($managerId);

// automatically get manager id from your profile
$preferences = $api->manager->preferences($managerId);
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

Remove resume:
```php
$api->resumes->delete($resumeId);
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
