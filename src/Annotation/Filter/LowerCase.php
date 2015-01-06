<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\LowerCase as LowerCaseFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class LowerCase extends FilterAnnotation
{
    public function __construct()
    {
        parent::__construct(LowerCaseFilter::class);
    }
}
