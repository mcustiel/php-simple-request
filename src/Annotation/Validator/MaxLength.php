<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MaxLength as MaxLengthValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class MaxLength extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MaxLengthValidator::class);
    }
}
