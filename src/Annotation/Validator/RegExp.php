<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\RegExp as RegExpValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class RegExp extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(RegExpValidator::class);
    }
}
