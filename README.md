# HeadHunter.ru api library (in process)

[![Code Climate](https://codeclimate.com/github/seregazhuk/php-headhunter-api/badges/gpa.svg)](https://codeclimate.com/github/seregazhuk/php-headhunter-api)
[![Test Coverage](https://codeclimate.com/github/seregazhuk/php-headhunter-api/badges/coverage.svg)](https://codeclimate.com/github/seregazhuk/php-headhunter-api/coverage)
[![Build Status](https://travis-ci.org/seregazhuk/php-headhunter-api.svg)](https://travis-ci.org/seregazhuk/php-headhunter-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/?branch=master)
[![Circle CI](https://circleci.com/gh/seregazhuk/php-headhunter-api.svg?style=shield)](https://circleci.com/gh/seregazhuk/php-headhunter-api)
[![Latest Stable Version](https://poser.pugx.org/seregazhuk/headhunter-api/v/stable)](https://packagist.org/packages/seregazhuk/headhunter-api)
[![Total Downloads](https://poser.pugx.org/seregazhuk/headhunter-api/downloads)](https://packagist.org/packages/seregazhuk/headhunter-api)

Provides a friendly api interface for HeadHunter (hh.ru) service.

Official api docs available [here](https://github.com/hhru/api).

 - [Installation](#installation)
 - [Quick Start](#quick-start)
 - [Vacancies](#vacancies)
 - [Employers](#employers)
 - [Artifacts](#artifacts)
 - [User](#user)
 - [Comments](#comments)
 - [Industries](#Industries)
 - [Negotiations](#negotiations)
 - [Regions](#regions)
 - [Resumes](#resumes)
 - [Saved searches](#saved-searches)
 - [Specializations](#specializations)


## Dependencies

Requires PHP 5.6 or above.


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
Get black listed vacancies ([official docs](https://github.com/hhru/api/blob/master/docs/blacklisted.md)):
```php 
$api->vacancies->blacklisted(); 
```

View vacancy by id ([official docs](https://github.com/hhru/api/blob/master/docs/vacancies.md)):
```php 
$vacancy = $api->vacancies->view($id); 
```

Search ([official docs](https://github.com/hhru/api/blob/master/docs/vacancies.md#search)):
```php 
$vacancies = $api->vacancies->search($params); 
```

### Employers

View employee by id ([official docs](https://github.com/hhru/api/blob/master/docs/employers.md#item)):
```php 
$employee = $api->employers->view($id); 
```

Search ([official docs](https://github.com/hhru/api/blob/master/docs/employers.md#search)):
```php 
$employers = $api->employers->search($params); 
```

### Artifacts:

Photo ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php 
$photo = $api->artifacts->photo(); 
```

Portfolio ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php 
$portfolio = $api->artifacts->portfolio(); 
```

### User:

Get current user info ([official docs](https://github.com/hhru/api/blob/master/docs/me.md)):
```php
$info = $api->me->info();
```

Update name(last, first, middle). All parameters are required ([official docs](https://github.com/hhru/api/blob/master/docs/me.md#edit)):
```php
$api->me->editName($lastName, $firstName, $middleName);
```

Update flag 'is_in_search' ([official docs](https://github.com/hhru/api/blob/master/docs/me.md#Флаг-ищу--не-ищу-работу)):
```php
$isInSearch = true; // or false;
$api->me->setIsInSearch($isInSearch);
```

Manager preferences by managerId. You can get your manager id from user object,
returned from `$api->me->info()`. When used without parameters your manager id will be
automatically resolved from your profile ([official docs](https://github.com/hhru/api/blob/master/docs/manager_settings.md)).

```php
$me = $api->me->info();
$managerId = $me['manager']['id'];
$preferences = $api->manager->preferences($managerId);

// automatically get manager id from your profile
$preferences = $api->manager->preferences($managerId);
```

### Applicant comments

Get all comments about applicant ([official docs](https://github.com/hhru/api/blob/master/docs/applicant_comments.md#list)):
```php 
$comments = $api->comments->view($applicantId); 
```

### Industries
Get all industries ([official docs](https://github.com/hhru/api/blob/master/docs/industries.md)):
```php 
$industries = $api->industries->all(); 
```

### Employee Negotiations

Get all negotiations ([official docs](https://github.com/hhru/api/blob/master/docs/negotiations.md#get_negotiations)):
```php 
$negotiations = $api->negotiations->all(); 
```

Get only active negotiations ([official docs](https://github.com/hhru/api/blob/master/docs/negotiations.md#get_negotiations_active)):
```php 
$negotiations = $api->negotiations->active(); 
```

Get messages of negotiation ([official docs](https://github.com/hhru/api/blob/master/docs/negotiations.md#get_messages)):
```php 
$messages = $api->negotiations->messages($negotiationId); 
```

### Regions

Get all regions ([official docs](https://github.com/hhru/api/blob/master/docs/areas.md#areas)):
```php 
$regions = $api->regions->all(); 
```

### Resumes

Get my resumes ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#mine)):
```php 
$resumes = $api->resumes->mine(); 
```

View resume ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#item)):
```php 
$views = $api->resumes->view($resumeId); 
```

Edit resume ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#create_edit)):
```php
$api->resumes->edit($resumeId, ['first_name' => 'New name']);
```

Create a new resume ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#create_edit)):
```php
$attributes = ['first_name' => 'New name'];
$result = $api->resumes->create($attributes);
```

Views history ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#views)):
```php 
$views = $api->resumes->views($resumeId);
```

Negotiations history ([official docs](https://github.com/hhru/api/blob/master/docs/resume_negotiations_history.md)):
```php
$negotiations = $api->resumes->negotiations($resumeId);
```

Update resume publish date ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#publish)):
```php 
$api->resumes->publish($resumeId); 
```

Get resume conditions ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#conditions)):
```php 
$conditions = $api->resumes->conditions($resumeId); 
```

Remove resume ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#delete)):
```php
$api->resumes->delete($resumeId);
```

Get current status (if it is blocked or ready to publish) ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#status-and-publication)):
```php
$status = $api->resumes->status($resumeId);
```

Get jobs recommendations for resume ([official docs](https://github.com/hhru/api/blob/master/docs/resumes.md#similar)):
```php
$jobs = $api->resumes->jobs($resumeId)
```

### Saved searches:

List searches ([official docs](https://github.com/hhru/api/blob/master/docs/saved_search.md#vacancies-saved-search-list)):
```php 
$searches = $api->savedSearches->all(); 
```

Get one search ([official docs](https://github.com/hhru/api/blob/master/docs/saved_search.md#vacancies-saved-search-item)):
```php 
$searches = $api->savedSearches->view($searchId); 
```

### Specializations

Get all specializations ([official docs](https://github.com/hhru/api/blob/master/docs/specializations.md)):
```php 
$specializations = $api->specializations->all(); 
```
