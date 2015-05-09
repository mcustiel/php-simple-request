<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Enum as EnumValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Enum extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(EnumValidator::class);
    }
}
