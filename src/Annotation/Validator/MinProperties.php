<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\MinProperties as MinPropertiesValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class MinProperties extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(MinPropertiesValidator::class);
    }
}
