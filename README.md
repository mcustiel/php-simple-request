php-simple-request
===============

What is it
==========

php-simple-request is a library designed to simplify requests validation and filtering, and generates an object from the request data.

The idea behind this library is to design objects that represent the requests the application receives, and use php-simple-request to map the request data to those objects. To do this, the library provides a set of annotations to specify the filters and validations to execute over the request data.

Installation
============

### Composer:

This project is published in packagist, so you just need to add it as a dependency in your composer.json:

```javascript
    "require": {
        // ...
        "mcustiel/php-simple-request": "1.0.*"
    }
```

If you want to access directly to this repo, adding this to your composer.json should be enough:

```javascript  
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/mcustiel/php-simple-request"
        }
    ],
    "require": {
        "mcustiel/php-simple-request": "dev-master"
    }
}
```

Or just download the release and include it in your path.

How to use it?
--------------

First of all, you have to define the classes that represents the requests you expect the application to receive:

```php
class PersonRequest 
{
    private $firstName;
    private $lastName;
    private $age;
    
    // getters and setters (setters are required by the library)
}
```

Then, you can specify the filters you want to apply on each field:
```php
class PersonRequest 
{
    @Trim
    private $firstName;
    @Trim
    @UpperCase
    private $lastName;
    private $age;
    
    // getters and setters (setters are required by the library)
}
```
And also the validations you want to run for each property value:
```php
class PersonRequest 
{
    @Trim
    @NotNull
    @NotEmpty
    private $firstName;
    @Trim
    @UpperCase
    @NotNull
    @NotEmpty
    @MaxLength(32)
    private $lastName;
    @Integer
    private $age;
    
    // getters and setters (setters are required by the library)
}
```
