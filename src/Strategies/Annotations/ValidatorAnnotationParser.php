<?php
namespace Mcustiel\SimpleRequest\Strategies\Annotations;

use Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser;
use Mcustiel\SimpleRequest\PropertyParser;
use Mcustiel\SimpleRequest\Util\ValidatorBuilder;
use Mcustiel\SimpleRequest\Annotation\AnnotationWithAssociatedClass;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;

class ValidatorAnnotationParser implements AnnotationParser
{
    /**
     * {@inheritdoc}
     * In this method, annotation param is treated as instance of AnnotationWithAssociatedClass.
     *
     * @see \Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser::execute()
     */
    public function execute(RequestAnnotation $annotation, PropertyParser $propertyParser)
    {
        $propertyParser->addValidator(
            ValidatorBuilder::builder()
                ->withClass($annotation->getAssociatedClass())
                ->withSpecification($annotation->getValue())
                ->build()
            );
    }
}
