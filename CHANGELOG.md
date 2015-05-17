CHANGELOG
=========

# Version 1.1.1

* Bugfixes in multipleOf, Integer and Float validators.

# Version 1.1.0: json-schema

* Issue 1: Validator compliance with JSON schema. Created validators in the style of json-schema but adapted to php-simple-request and the functionality of php (Example: properties/additionalProperties work with stdClass AND associative arrays).
* Added more unit tests.
* Bugfixes.

# Version 1.0.1: PSR4

* Changed paths to support PSR4.

# Version 1.0.0: First fully functional version.

* This version has all the needed features to use php-simple-request:
** FirstErrorParser
** AllErrorsParser
** 5 filters including a customizable one.
** 13 validators including a customizable one.
** File caching support.
** Annotation parsing.
** Performance optimizations.

