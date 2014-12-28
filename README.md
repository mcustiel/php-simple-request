php-simple-request
===============

What is it
----------

php-simple-request is a library designed to simplify requests validation and filtering, that generates an object representation from the request data.

The idea behind this library is to design objects that represent the requests that the application receives, and use php-simple-request to map the request data to those objects. To do this, the library provides a set of annotations to specify the filters and validations to execute over the request data.

This library is optimized to be performant by using a cache system to save the parser classes generated by reading the annotations.

Installation
------------

#### Composer:

This project is published in packagist, so you just need to add it as a dependency in your composer.json:

```javascript
    "require": {
        // ...
        "mcustiel/php-simple-request": ">=1.0.0"
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

First of all, you have to define the classes that represent the requests you expect the application to receive. The setter methods of this class will be used by php-simple-request to write the values obtained from the request into the object.

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
    /**
     * @Trim
     */
    private $firstName;
    /**
     * @Trim
     * @UpperCase
     */
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
use Mcustiel\SimpleRequest\Annotation\Validator\NotEmpty;
use Mcustiel\SimpleRequest\Annotation\Validator\MaxLength;
use Mcustiel\SimpleRequest\Annotation\Validator\Integer;

class PersonRequest 
{
    /**
     * @Trim
     * @NotEmpty
     */
    private $firstName;
    /**
     * @Trim
     * @UpperCase
     * @NotEmpty
     * @MaxLength(32)
     */
    private $lastName;
    /**
     * @Integer
     */
    private $age;
    
    // getters and setters (setters are required by the library)
}
```

**Note**: php-simple-request executes the filters and then it executes the validations.

#### Parse the request and get an object representation

To parse the request and convert it to your object representation, just receive the request using the RequestBuilder object (the field names in the request must have the same name to the fields in the class you defined). See an example:

```php
use Mcustiel\SimpleRequest\RequestBuilder;
use Your\Namespace\PersonRequest;
use Mcustiel\SimpleRequest\Exceptions\InvalidValueException;

$requestBuilder = new RequestBuilder();
try {
    $personRequest = $requestBuilder->parseRequest($_POST, PersonRequest::class);
} catch (InvalidValueException $e) {
    die("The request is invalid: " . $e->getMessage());
}
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

This behavior throws an exception when it finds an error in the validation. It's the default behavior.
There is an alternative behavior in which you can obtain a list of validation errors, one for each invalid field. To activate this alternative behavior, you have to specify the parser in the call to RequestBuilder::parseRequest like this:

```php
use Mcustiel\SimpleRequest\RequestBuilder;
use Your\Namespace\PersonRequest;

$requestBuilder = new RequestBuilder();

$parserResponse = $requestBuilder->parseRequest($_POST, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
if (!$parserResponse->isValid()) {
    die (var_export($parserResponse->getErrors(), true));
}
$personRequest = $parserResponse->getRequestObject();

// Now you can use the validated and filtered personRequest to access the requestData.
```

#### File caching:

As the request class definition uses annotations to specify filters and validators, it generates a lot of overhead when parsing all those annotations. To avoid this overhead, php-simple-request saves the parser in a cache file. To deactivate the cache (for instance, in development environment), a config object must be provided in the RequestBuilder constructor specifying that caching must be disabled:

```php
$cacheConfig = new \stdClass;
$cacheConfig->disabled = true;
$requestBuilder = new RequestBuilder($cacheConfig);
```  

You can also specify the base path for the cache files using the same config object:

```php
$cacheConfig = new \stdClass;
$cacheConfig->path = '/your/own/cache/path';
$requestBuilder = new RequestBuilder($cacheConfig);
```  

Filters
-------

#### Capitalize

This filter sets all the string characters to lowercase but its first character, which is converted to uppercase. This annotation accepts a boolean specifier value to define wether to capitalize just the first letter of the first word or the first letter of all words in the string.  

```php
/**
 * @Capitalize
 */
private $name;
// Will convert, for instance, mariano to Mariano.
/**
 * @Capitalize(true)
 */
private $fullName;
// Will convert, for instance, mariano custiel to Mariano Custiel.
```

#### CustomFilter

This is a special filter annotation that allows you to specify your own filter class and use it to filter the value in the field. It accepts two parameters: 
* value: which is the specifier.
* class: which is your custom filter class (it must implement Mcustiel\SimpleRequest\Interfaces\FilterInterface

```php
/**
 * @CustomFilter(class="Vendor\\App\\MyFilters\\MyFilter", value="yourSpecifier")
 */
private $somethingHardToFilter;
// Will call Vendor\\App\\MyFilters\\MyFilter::filter($value) using "yourSpecifier".
```

#### LowerCase

LowerCase filter converts all characters in the given string to lowercase.

#### Trim

Trims the string from both ends.

#### UpperCase

Converts all characters in the given string to uppercase.

Validators
----------

#### CustomValidator

This is a special validator annotation that allows you to specify your own validator class and use it to validate the value in the field. It accepts two parameters: 
* value: which is the specifier.
* class: which is your custom filter class (it must implement Mcustiel\SimpleRequest\Interfaces\ValidatorInterface


##### Example:
```php
/**
 * @CustomValidator(class="Vendor\\App\\MyValidators\\MyValidator", value="yourSpecifier")
 */
private $somethingHardToCheck;
// Will call Vendor\\App\\MyValidators\\MyValidator::validate($value) using "yourSpecifier".
```

**Default specifier value:** \DateTime::ISO8601

#### Date

This validator checks that the given string is a date and its format is compatible with the specified date format. The format to specify as the annotation value must be compatible with the php method \DateTime::createFromFormat.

##### Example:
```php
/**
 * @Date("M d, Y")
 */
private $dayOfBirth;
// Matches Oct 17, 1981
```

**Default specifier value:** \DateTime::ISO8601

#### Email

This validator checks that the given value is a string containing an email. This annotation expects no value specifier.

##### Example:
```php
/**
 * @Email
 */
private $email;
```

#### Float

This validator checks that the given value is a float. A boolean modifier can be specified in this annotation, indicating if the value must be a strict float or if integers can be validated as floats too.

##### Example:
```php
/**
 * @Float
 */
private $meters;
```

###### Example:
```php
// accepts 1, 1.1, etc.
/**
 * @Float(true)
 */
private $meters;
// accepts 1.0, 1.1, etc.
```

**Default specifier value:** false, indicating that integers are validated as floats

#### Integer

This validator checks that the given value is numeric and it's an integer. It does not expect any modifier.

##### Example:
```php
/**
 * @Integer
 */
private $seconds;
// accepts 1, 2, -3, 0, etc.
```

#### IPV4

This validator checks that the given value is a valid IPv4. It does not expect any modifier.

##### Example:
```php
/**
 * @IPV4
 */
private $ip;
// accepts 0.0.0.0, 255.255.255.255, etc.
```

#### IPV6

This validator checks that the given value is a valid IPv6. It does not expect any modifier.

##### Example:
```php
/**
 * @IPV6
 */
private $ip;
// accepts ::A000:A000, A000::A000, A000::A000::, 2001:0000:3238:DFE1:63:0000:0000:FEFB, etc.
```

#### MaxLength

This validator checks that the field's length is equal to or less than the specification. The specification value must be an integer. The field can be a string or an array.

##### Example:
```php
/**
 * @MaxLength(4)
 */
private $pin;
// accepts empty string, 1, 12, 123 and 1234.
```

**Default specifier value:** 255

#### MinLength

This validator checks that the field's length is equal to or greater than the specification. The specification value must be an integer. The field can be a string or an array.

##### Example:
```php
/**
 * @MinLength(8)
 */
private $password;
// accepts 'password', 'password1', 'password1234' and all those very secure passwords.
```

**Default specifier value:** 0

#### NotEmpty

This validator checks that the field's is not empty. Internally, this validator uses php's empty so the functionality is exactly the same. It does not expect any modifier.

##### Example:
```php
/**
 * @NotEmpty
 */
private $password;
// accepts 1, 'A', ['a'], etc.
```

**Default specifier value:** 0

#### NotNull

This validator checks that the field's is not null, it can be used to check if the field is present in the request also. Use this function only if you want to check the value is present and you accept empty values in the field; if you will not accept empty values, just use NotEmpty validator which also checks values is not null. It does not expect any modifier.

##### Example:
```php
/**
 * @NotNull
 */
private $mandatoryField;
// accepts '', 0, [], 1, 'A', ['a'], etc.
```

#### RegExp

This validator checks the field against a given regular expression.

##### Example:
```php
/**
 * @RegExp("/[a-z]*/i")
 */
private $onlyAlpha;
// accepts '', 'a', 'A', 'ab', etc.
```

#### TwitterAccount

This validator checks that the field contains a twitter account.

##### Example:
```php
/**
 * @TwitterAccount
 */
private $twitterAccount;
// accepts '@user', '@user_name_1', etc.
```

#### Url

This validator checks that the field contains a valid URL.

##### Example:
```php
/**
 * @Url
 */
private $webpage;
// accepts 'localhost', 'www.server.com', 'http://www.webserver.com/page.php?t=1#anchor', etc
```

TODO
----

* Add INTL support for float validator.
