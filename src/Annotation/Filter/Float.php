<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\Integer as IntegerFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Integer extends FilterAnnotation
{
    public function __construct()
    {
        parent::__construct(IntegerFilter::class);
    }
}
