<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\NotEmpty as NotEmptyValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class NotEmpty extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(NotEmptyValidator::class);
    }
}
