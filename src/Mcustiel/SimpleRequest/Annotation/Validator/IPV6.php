<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\IPV6 as IPV6Validator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class IPV6 extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(IPV6Validator::class);
    }
}
