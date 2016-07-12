<?php
namespace Mcustiel\SimpleRequest\Strategies\Annotations;

use Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser;
use Mcustiel\SimpleRequest\PropertyParser;
use Mcustiel\SimpleRequest\Util\FilterBuilder;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;

class FilterAnnotationParser implements AnnotationParser
{
    /**
     * {@inheritdoc}
     * In this method, annotation param is treated as instance of AnnotationWithAssociatedClass.
     *
     * @see \Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser::execute()
     */
    public function execute(RequestAnnotation $annotation, PropertyParser $propertyParser)
    {
        $propertyParser->addFilter(
            FilterBuilder::builder()
                ->withClass($annotation->getAssociatedClass())
                ->withSpecification($annotation->getValue())
                ->build()
        );
    }
}
