<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\TwitterAccount as TwitterAccountValidator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class TwitterAccount extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(TwitterAccountValidator::class);
    }
}
