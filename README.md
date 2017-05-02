# HeadHunter.ru API library (in process)

[![Code Climate](https://codeclimate.com/github/seregazhuk/php-headhunter-api/badges/gpa.svg)](https://codeclimate.com/github/seregazhuk/php-headhunter-api)
[![Test Coverage](https://codeclimate.com/github/seregazhuk/php-headhunter-api/badges/coverage.svg)](https://codeclimate.com/github/seregazhuk/php-headhunter-api/coverage)
[![Build Status](https://travis-ci.org/seregazhuk/php-headhunter-api.svg)](https://travis-ci.org/seregazhuk/php-headhunter-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/seregazhuk/php-headhunter-api/?branch=master)
[![Circle CI](https://circleci.com/gh/seregazhuk/php-headhunter-api.svg?style=shield)](https://circleci.com/gh/seregazhuk/php-headhunter-api)
[![Latest Stable Version](https://poser.pugx.org/seregazhuk/headhunter-api/v/stable)](https://packagist.org/packages/seregazhuk/headhunter-api)
[![Total Downloads](https://poser.pugx.org/seregazhuk/headhunter-api/downloads)](https://packagist.org/packages/seregazhuk/headhunter-api)

Provides a friendly API interface for HeadHunter (hh.ru) service.

Official API docs available [here](https://github.com/hhru/api).

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
 - [Dictionaries](#dictionaries)
 - [Suggests](#suggests)


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

Get similar vacancies for the current one ([official docs](https://github.com/hhru/api/blob/master/docs/vacancies.md#similar)):
```php
$similarVacancies = $api->vacancies->similar($id);
```

Get list of favorited vacancies ([official docs](https://github.com/hhru/api/blob/master/docs/vacancies.md#favorited)):
```php
$vacancies = $api->vacancies->favorited();
```

Search ([official docs](https://github.com/hhru/api/blob/master/docs/vacancies.md#search)):
```php 
$vacancies = $api->vacancies->search($params); 
```

Vacancy statistics ([officials docs](https://github.com/hhru/api/blob/master/docs/employer_vacancies.md#stats)):
```php
$stats = $api->vacancies->statistics($vacancyId);
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

Get your photos ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php 
$photos = $api->artifacts->photos();
```

Get your portfolio ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php 
$portfolio = $api->artifacts->portfolio(); 
```

Delete photo by id ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php
$api->artifacts->deletePhoto($photoId);
```

Edit photo attributes ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php
$api->artifacts->editPhoto($photoId, $attributes);
```

Upload photo ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php
$api->artifacts->uploadPhoto('photo.jpg', 'my picture description');
```

Upload portfolio ([official docs](https://github.com/hhru/api/blob/master/docs/artifacts.md)):
```php
$api->artifacts->uploadPortfolio('portfolio.jpg', 'my portfolio description');
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

Create a comment ([official docs](https://github.com/hhru/api/blob/master/docs/applicant_comments.md#add_comment)).
You need an applicant id, to create a comment. Applicant id can be received from resume:

```php
$resumeInfo = $api->resume->view($resumeId);
$applicantCommentsUrl = $resumeInfo['owner']['comments']['url']; // https://api.hh.ru/applicant_comments/2743747
// You need to parse id from this url

// Create a comment, that is visible for coworkers
$result = $api->comments($applicantId, 'my comment');

// Create a comment, that is visible only for you
$result = $api->createPrivate($applicantId, 'my comment');
```

Edit comment ([official docs](https://github.com/hhru/api/blob/master/docs/applicant_comments.md#edit_comment)):

```php
// Edit a comment, that is visible for coworkers
$api->comments->edit($applicantId, $commentId, 'new comment text')

// Edit a comment, that is visible only for you
$result = $api->editPrivate($applicantId, $commentId, 'new comment text');
```

Delete a comment ([official docs](https://github.com/hhru/api/blob/master/docs/applicant_comments.md#delete_comment)):

```php
$api->comments->delete($applicantId, $commentId);
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

View the list of messages.

- For employee: get messages of negotiation ([official docs](https://github.com/hhru/api/blob/master/docs/negotiations.md#get_messages)):
- For employer: view the list of messages in the response/invitation ([official docs](https://github.com/hhru/api/blob/master/docs/employer_negotiations.md#view-the-list-of-messages-in-the-responseinvitation)):
```php 
$api->negotiations->message($negotiationId, $messageText);
```

Sending new message.

- For employee: create a new message ([official docs](https://github.com/hhru/api/blob/master/docs/negotiations.md#send_message)):
- For employer: sending a message in the response/invitation ([official docs](https://github.com/hhru/api/blob/master/docs/employer_negotiations.md#sending-a-message-in-the-responseinvitation)):

Git list of responses/invitation for ([official docs](https://github.com/hhru/api/blob/master/docs/employer_negotiations.md)):
```php
$responses = $api->negotiations->invited($vacancyId);
```

View the response/invitation by id. NegotiationId can be taken from key url in the `invited` call response.
([official docs](https://github.com/hhru/api/blob/master/doc/employer_negotiations.md)):
```php
$response = $api->negotiations->view($negotiationId);

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

### Dictionaries

Get list of entities that are used in API ([official docs](https://github.com/hhru/api/blob/master/docs/specializations.md)):
```php
$dictionaries = $api->dictionaries->all();
```

### Suggests

Educational institutions ([official docs](https://github.com/hhru/api/blob/master/docs/suggests.md#Подсказки-по-названиям-университетов)):
```php
$suggests = $api->suggests->educational_institutions($text);
```

Companies ([official docs](https://github.com/hhru/api/blob/master/docs/suggests.md#companies)):
```php
$suggests = $api->suggests->companies($text);
```