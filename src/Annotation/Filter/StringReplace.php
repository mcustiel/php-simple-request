<?php
namespace Mcustiel\SimpleRequest\Annotation\Filter;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Filter\StringReplace as StringReplaceFilter;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class StringReplace extends FilterAnnotation
{
    public $pattern;
    public $replacement;

    public function __construct()
    {
        parent::__construct(StringReplaceFilter::class);
    }

    public function getValue()
    {
        return ['pattern' => $this->pattern, 'replacement' => $this->replacement];
    }
}
