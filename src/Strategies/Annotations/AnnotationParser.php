<?php
namespace Mcustiel\SimpleRequest\Strategies\Annotations;

use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;
use Mcustiel\SimpleRequest\PropertyParser;

interface AnnotationParser
{
    /**
     * @param \Mcustiel\SimpleRequest\Annotation\RequestAnnotation $annotation
     * @return
     */
    public function execute(RequestAnnotation $annotation, PropertyParser $propertyParser);
}
