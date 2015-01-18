# [APK Parser](https://github.com/evozi/apk-parser-php)
[![Packagist License](https://poser.pugx.org/evozi/apk-parser-php/license.png)](http://choosealicense.com/licenses/mit/)
[![Latest Stable Version](https://poser.pugx.org/evozi/apk-parser-php/version.png)](https://packagist.org/packages/evozi/apk-parser-php)
[![Total Downloads](https://poser.pugx.org/evozi/apk-parser-php/d/total.png)](https://packagist.org/packages/evozi/apk-parser-php)

This package can extract application package files in APK format used by devices running on Android OS.
It can open an APK file and extract the contained manifest file to parse it and retrieve the meta-information
it contains like the application name, description, device feature access permission it requires, etc..
The class can also extract the whole files contained in the APK file to a given directory.

### Requirements

PHP 5.3+

# Installation

## Composer

### Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
```

### Install via composer by hand

Create a composer.json into your project and add to your composer.json file by hand.

```javascript
{
    ...
    "require": {
        ...
        "evozi/apk-parser-php":"dev-master"
    }
    ...
}
```


Once you have added this, just run:

```bash
php composer.phar update evozi/apk-parser-php
```
or
```bash
composer install
```bash

### Install using composer

```bash
php composer.phar require evozi/apk-parser-php:dev-master
```


# Testing

Tests are powered by PHPUnit. You have several options.

- Run `phpunit` if PHPUnit is installed globally.
- Install dependencies (requires [Composer](https://getcomposer.org/download)).
  Run `php composer.phar --dev install` or `composer --dev install`. Then `bin/vendor/phpunit` to run version
  installed by Composer. This ensures that you are running a version compatible with the test suite.


# License

APK Parser is [MIT licensed](./LICENSE.md).