<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MaxItems as MaxItemsValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class MaxItems extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MaxItemsValidator::class);
    }
}
