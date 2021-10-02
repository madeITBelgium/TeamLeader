# PHP TeamLeader API Laravel SDK
[![Build Status](https://travis-ci.org/madeITBelgium/TeamLeader.svg?branch=master)](https://travis-ci.org/madeITBelgium/TeamLeader)
[![Coverage Status](https://coveralls.io/repos/github/madeITBelgium/TeamLeader/badge.svg?branch=master)](https://coveralls.io/github/madeITBelgium/TeamLeader?branch=master)
[![Latest Stable Version](https://poser.pugx.org/madeITBelgium/TeamLeader/v/stable.svg)](https://packagist.org/packages/madeITBelgium/TeamLeader)
[![Latest Unstable Version](https://poser.pugx.org/madeITBelgium/TeamLeader/v/unstable.svg)](https://packagist.org/packages/madeITBelgium/TeamLeader)
[![Total Downloads](https://poser.pugx.org/madeITBelgium/TeamLeader/d/total.svg)](https://packagist.org/packages/madeITBelgium/TeamLeader)
[![License](https://poser.pugx.org/madeITBelgium/TeamLeader/license.svg)](https://packagist.org/packages/madeITBelgium/TeamLeader)

With this Laravel package you can create a TeamLeader integration.

# Installation

```
composer require madeitbelgium/teamleader
```

Or require this package in your `composer.json` and update composer.

```php
"madeitbelgium/teamleader": "^1.0"
```

## Publish config file
```php
php artisan vendor:publish --provider="MadeITBelgium\TeamLeader\ServiceProvider\TeamLeader"
```

## Laravel <5.5
After updating composer, add the ServiceProvider to the providers array in `config/app.php`

```php
MadeITBelgium\TeamLeader\ServiceProvider\TeamLeader::class,
```

You can use the facade for shorter code. Add this to your aliases:

```php
'TeamLeader' => MadeITBelgium\TeamLeader\Facade\TeamLeader::class,
```

# Documentation
## Usage
```php

use MadeITBelgium\TeamLeader\TeamLeader;

$teamLeader = new TeamLeader($appUrl, $clientId, $clientSecret, $redirectUri, $client = null);
```

In laravel you can use the Facade
```php
$teamLeaderContact = TeamLeader::crm()->contact()->add([
    'first_name' => 'Tjebbe',
    'last_name' => 'Lievens',
    'emails' => [
        [
            'type' => 'primary',
            'email' => 'info@madeit.be',
        ]
    ],
    'telephones' => [
        ['type' => 'mobile', 'number' => '0000000000'],
    ],
    'addresses' => [
        [
            'type' => 'primary',
            'address' => [
                'line_1' => 'Adres 1',
                'postal_code' => '1234',
                'city' => 'Cityname',
                'country' => 'BE',
            ]
        ]
    ],
    'language' => "nl",
]);
$contactId = $teamLeaderContact->data->id;
```

## Authentication
Create a redirect URL and redirect the user to the teamleader URL.
```php
TeamLeader::setRedirectUrl($redirect_url);
$redirectTo = TeamLeader::getAuthorizationUrl();
```

When the user succesfully is authenticated. The user is redirect to the provided redirect URL. You can now request (and save) the access and refersh token.
```php
$accessTokenResult = TeamLeader::requestAccessToken($request->get('code'));
$access_token = TeamLeader::getAccessToken();
$refresh_token = TeamLeader::getRefreshToken();
$expired_at = TeamLeader::getExpiresAt();
```

The access token has a short expire time. Before each reqeust check if the access token is still valid. 
```php
TeamLeader::setAccessToken($access_token);
TeamLeader::setRefreshToken($refresh_token);
TeamLeader::setExpiresAt($expired_at);
$refresh = TeamLeader::checkAndDoRefresh();
if (false !== $refresh) {
    $access_token = TeamLeader::getAccessToken();
    $refresh_token = TeamLeader::getRefreshToken();
    $expired_at = TeamLeader::getExpiresAt();
    //Save data to database
}
```

## All available endpoints
Need more endpoints? Create an issue or contact us.
```php
TeamLeader::setRedirectUrl($redirect_url);
TeamLeader::getAuthorizationUrl();

TeamLeader::requestAccessToken($code);
TeamLeader::getAccessToken();
TeamLeader::getRefreshToken();
TeamLeader::getExpiresAt();

TeamLeader::setAccessToken($access_token);
TeamLeader::setRefreshToken($refresh_token);
TeamLeader::setExpiresAt($expired_at);
TeamLeader::checkAndDoRefresh();

TeamLeader::crm()->contact()->list(['filter' => ..., 'page' => ..., 'sort' => ...]); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.list
TeamLeader::crm()->contact()->info($id); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.info
TeamLeader::crm()->contact()->add(['first_name' => ..., ...]); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.add
TeamLeader::crm()->contact()->update($id, ['first_name' => ...]) //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.update
TeamLeader::crm()->contact()->delete($id); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.delete
TeamLeader::crm()->contact()->tag($id, $tags); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.tag
TeamLeader::crm()->contact()->untag($id, $tags); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.untag
TeamLeader::crm()->contact()->linkToCompany($id, $companyId, $position, $decisionMaker) //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.linktocompany
TeamLeader::crm()->contact()->unlinkToCompany($id, $companyId); //https://developer.focus.teamleader.eu/#/reference/crm/contacts/contacts.unlinkfromcompany

TeamLeader::deals()->list($data = []); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.list
TeamLeader::deals()->info($id); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.info
TeamLeader::deals()->create($data); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.create
TeamLeader::deals()->update($id, $data); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.update
TeamLeader::deals()->move($id, $phaseId); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.move
TeamLeader::deals()->win($id); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.win
TeamLeader::deals()->lose($id, $reason_id = null, $extra_info = null); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.lose
TeamLeader::deals()->delete($id); //https://developer.focus.teamleader.eu/#/reference/deals/deals/deals.delete
TeamLeader::deals()->lostReasons($data = []); //https://developer.focus.teamleader.eu/#/reference/deals/deals/lostreasons.list


TeamLeader::webhooks()->list(); //https://developer.focus.teamleader.eu/#/reference/other/webhooks/webhooks.list
TeamLeader::webhooks()->register($data); //https://developer.focus.teamleader.eu/#/reference/other/webhooks/webhooks.register
TeamLeader::webhooks()->unregister($url, $types); //https://developer.focus.teamleader.eu/#/reference/other/webhooks/webhooks.unregister
```

The complete documentation can be found at: [http://www.madeit.be/](http://www.madeit.be/)

# Support

Support github or mail: tjebbe.lievens@madeit.be

# Contributing

Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/
# License

This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
