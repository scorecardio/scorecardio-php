# Scorecardio-php

This Scorecardio PHP library provides convenient access to the Scorecardio API from applications written in PHP language.

## requirements
PHP 5.6.0 and later

## Composer

You can install the package via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require scorecardio/scorecardio-php
```

## Getting Started

Simple usage looks like:

```php
$scorecard = new \Scorecardio\Scorecard('4eC39HqLyjWDarjtT1zdp7dc');
$result = $scorecard->executePublishedScorecard('Partner name', 'Scorecard name', [
            'work_contract' => 'yes',
            'nationality' => 'Netherlands',
            'date_of_birth' => '21-11-1990',
            'marital_status' => 'single',
            'number_of_current_loans' => 0,
            'number_of_past_loans' => 1,
            'loan_defaults' => 0
        ]);
```