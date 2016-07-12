<?php
namespace Mcustiel\SimpleRequest\Strategies\Annotations;

use Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser;
use Mcustiel\SimpleRequest\PropertyParser;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;

class ParseAsAnnotationParser implements AnnotationParser
{
    public function execute(RequestAnnotation $annotation, PropertyParser $propertyParser)
    {
        $propertyParser->setType($annotation->getValue());
    }
}
