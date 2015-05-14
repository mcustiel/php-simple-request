<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Not as NotValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class Not extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(NotValidator::class);
    }
}
