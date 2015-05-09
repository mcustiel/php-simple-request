<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MultipleOf as MultipleOfValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class MultipleOf extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MultipleOfValidator::class);
    }
}
