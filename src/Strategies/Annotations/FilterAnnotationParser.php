<?php
namespace Mcustiel\SimpleRequest\Strategies\Annotations;

use Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser;
use Mcustiel\SimpleRequest\PropertyParser;
use Mcustiel\SimpleRequest\Util\FilterBuilder;
use Mcustiel\SimpleRequest\Annotation\AnnotationWithAssociatedClass;

class FilterAnnotationParser implements AnnotationParser
{
    public function execute(AnnotationWithAssociatedClass $annotation, PropertyParser $propertyParser)
    {
        $propertyParser->addFilter(
            FilterBuilder::builder()
                ->withClass($annotation->getAssociatedClass)
                ->withSpecification($annotation->getValue())
                ->build()
        );
    }
}
