<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\NotNull as NotNullValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class NotNull extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(NotNullValidator::class);
    }
}