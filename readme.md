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

The complete documentation can be found at: [http://www.madeit.be/](http://www.madeit.be/)

# Support

Support github or mail: tjebbe.lievens@madeit.be

# Contributing

Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/
# License

This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
