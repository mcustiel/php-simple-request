<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\Capitalize as CapitalizeFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Capitalize extends FilterAnnotation
{
    public function __construct()
    {
        parent::__construct(CapitalizeFilter::class);
    }
}
