<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\RegexReplace as RegexReplaceFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class RegexReplace extends StringReplace
{
    public function __construct()
    {
        parent::__construct(RegexReplaceFilter::class);
    }
}
