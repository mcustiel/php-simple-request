<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\UniqueItems as UniqueItemsValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class UniqueItems extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(UniqueItemsValidator::class);
    }
}
