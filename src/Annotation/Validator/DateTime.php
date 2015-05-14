<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Date as DateValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class DateTimeFormat extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(DateValidator::class);
    }

    public function getValue()
    {
        return \DateTime::RFC3339;
    }
}
