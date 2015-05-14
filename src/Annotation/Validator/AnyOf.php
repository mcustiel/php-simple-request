<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\AnyOf as AnyOfValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class AnyOf extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(AnyOfValidator::class);
    }
}
