<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\IPV4 as IPV4Validator;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class IPV4 extends ValidatorAnnotation
{
    public function __construct()
    {
        parent::__construct(IPV4Validator::class);
    }
}
