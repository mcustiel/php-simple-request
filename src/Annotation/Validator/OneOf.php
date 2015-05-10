<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\OneOf as OneOfValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class OneOf extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(OneOfValidator::class);
    }
}
