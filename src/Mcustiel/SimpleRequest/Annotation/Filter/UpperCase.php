<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\UpperCase as UpperCaseFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class UpperCase extends FilterAnnotation
{
    public function __construct()
    {
        parent::__construct(UpperCaseFilter::class);
    }
}
