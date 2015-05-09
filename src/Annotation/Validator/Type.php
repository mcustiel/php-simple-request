<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Required as RequiredValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Required extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(RequiredValidator::class);
    }
}
