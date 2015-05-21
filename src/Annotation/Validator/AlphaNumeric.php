<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\AlphaNumeric as AlphaNumValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class AlphaNumeric extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(AlphaNumValidator::class);
    }
}
