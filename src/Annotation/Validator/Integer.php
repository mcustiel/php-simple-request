<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Integer as IntegerValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Integer extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(IntegerValidator::class);
    }
}
