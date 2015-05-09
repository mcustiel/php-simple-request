<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MaxProperties as MaxPropertiesValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class MaxProperties extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MaxPropertiesValidator::class);
    }
}
