<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Maximum as MaximumValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Maximum extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MaximumValidator::class);
    }
}
