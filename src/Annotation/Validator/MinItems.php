<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MinItems as MinItemsValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class MinItems extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MinItemsValidator::class);
    }
}
