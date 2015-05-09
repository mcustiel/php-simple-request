<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\ExclusiveMaximum as ExclusiveMaximumValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class ExclusiveMaximum extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(ExclusiveMaximumValidator::class);
    }
}
