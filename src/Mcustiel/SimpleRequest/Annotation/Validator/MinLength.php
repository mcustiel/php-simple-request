<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MinLength as MinLengthValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class MinLength extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MinLengthValidator::class);
    }
}
