Password Hash Library
=====================

[![Build Status](https://travis-ci.org/pentagonal/phpass.svg?branch=master)](https://travis-ci.org/pentagonal/phpass)

Script base on Openwall's [Phpass](http://openwall.com/phpass/), based on the 0.3 release, change to ready for:

- Name Space
- Composer (Autoload)
- PHP 5
- Unit Tested

There was make some changes and add 2 methods & Name Space , to make the password hash could use install on composer and Name Space Support.

We are not claim of the projects, but we just add some comments and make more compatible with new version of PHP for our projects.

## Change & Additional

- Dump version to 1.0
- Add Comments
- Adding visibility on methods & property
- Add 2 methods alternative `check` & `hash`
- Remove /dev/urandom , that maybe thrown of error as random state ( default uses loop )


## Installation

Add requirement to the `composer.json` file and run `composer install`:

```
    {
        "require": {
            "pentagonal/phpass": "1.0"
        }
    }
```

## Usage

``` php

<?php
/**
 * Require Autoload From Vendor
 */
require_once(__DIR__ . "/vendor/autoload.php");

/**
 * Initiate of PasswordHash
 * @type Object instance of Pentagonal\Phpass\PasswordHash
 */
$passwordHasher = new Pentagonal\Phpass\PasswordHash(8,false);

/**
 * Hash the string of password
 * @uses hashPassword([string] password) | or use hash([string] password) as another method aliases
 * @type string
 */
$HashedPassword = $passwordHasher->hashPassword('The String Plain Text Password');

/**
 * Check password match
 * @uses checkPassword([string] password, [string] hashedPassword) | or use check([string] password, [string] hashedPassword) as another method aliases
 * @type string
 */
$isPasswordMatch = $passwordHasher->checkPassword('The String Plain Text Password', $HashedPassword);

```
