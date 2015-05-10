<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\ExclusiveMinimum as ExclusiveMinimumValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class ExclusiveMinimum extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(ExclusiveMinimumValidator::class);
    }
}
