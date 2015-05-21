<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\Float as FloatFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Float extends FilterAnnotation
{
    public function __construct()
    {
        parent::__construct(FloatFilter::class);
    }
}
