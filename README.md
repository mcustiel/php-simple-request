php-simple-request
===============

What is it
----------

php-simple-request is a library designed to simplify requests validation and filtering, and generates an object from the request data.

The idea behind this library is to design objects that represent the requests the application receives, and use php-simple-request to map the request data to those objects. To do this, the library provides a set of annotations to specify the filters and validations to execute over the request data.

Installation
------------

#### Composer:

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

#### Define objects to represent the requests

First of all, you have to define the classes that represents the requests you expect the application to receive:

```php
namespace Your\Namespace;

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
namespace Your\Namespace;
use Mcustiel\SimpleRequest\Annotation\Filter\Trim;
use Mcustiel\SimpleRequest\Annotation\Filter\UpperCase;

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
namespace Your\Namespace;
use Mcustiel\SimpleRequest\Annotation\Filter\Trim;
use Mcustiel\SimpleRequest\Annotation\Filter\UpperCase;
use Mcustiel\SimpleRequest\Annotation\Validator\NotNull;
use Mcustiel\SimpleRequest\Annotation\Validator\NotEmpty;
use Mcustiel\SimpleRequest\Annotation\Validator\MaxLength;
use Mcustiel\SimpleRequest\Annotation\Validator\Integer;

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


#### Parse the request and get an object representation

And just receive the request using the RequestBuilder object (the field names must be equal to the fields in the class you defined)

```php
use Mcustiel\SimpleRequest\RequestBuilder;
use Your\Namespace\PersonRequest;

$requestBuilder = new RequestBuilder();
$personRequest = $requestBuilder->parseRequest($_POST, PersonRequest::class);
// Now you can use the validated and filtered personRequest to access the requestData.
```

If your request is received as a subarray of POST, just specify the key:

```php
$personRequest = $requestBuilder->parseRequest($_POST['person'], PersonRequest::class);
```

Also it can be used for some REST json request:

```php
$request = file_get_contents('php://input');
$personRequest = $requestBuilder->parseRequest(json_decode($request), PersonRequest::class);
```

#### Improve performance activating file caching:

As the request class definition uses annotations to specify filters and validators, it generates a lot of overhead when parsing all those annotations. To avoid this overhead, php-simple-request allows to save the parser in a cache file. To activate the cache, a config object must be provided in the RequestBuilder constructor:

```php
$cacheConfig = new \stdClass;
$cacheConfig->enabled = true;
$requestBuilder = new RequestBuilder($cacheConfig);
```  

You can also specify the base path for the cache files:

```php
$cacheConfig = new \stdClass;
$cacheConfig->enabled = true;
$cacheConfig->path = '/your/own/cache/path';
$requestBuilder = new RequestBuilder($cacheConfig);
```  

