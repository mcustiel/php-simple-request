<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\RegExp as RegExpValidator;

/**
 * This is an alias for RegExp.
 *
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Pattern extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(RegExpValidator::class);
    }
}
