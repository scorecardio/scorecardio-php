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

Want to execute a specific scorecard version: 

```php
$scorecard = new \Scorecardio\Scorecard('4eC39HqLyjWDarjtT1zdp7dc');

$result = $scorecard->executeScorecardVersion('Partner name', 'Scorecard name', 3, [
            'work_contract' => 'yes',
            'nationality' => 'Netherlands',
            'date_of_birth' => '21-11-1990',
            'marital_status' => 'single',
            'number_of_current_loans' => 0,
            'number_of_past_loans' => 1,
            'loan_defaults' => 0
        ]);
```

Or fetch a previous scoring again:

```php
$scoring = new \Scorecardio\Scoring('4eC39HqLyjWDarjtT1zdp7dc');

$result = $scoring->fetchScoring('72983022-84df-4d67-8809-c97648f2b59e');
```
