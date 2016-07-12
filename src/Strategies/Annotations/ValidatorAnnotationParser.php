<?php
namespace Mcustiel\SimpleRequest\Strategies\Annotations;

use Mcustiel\SimpleRequest\Strategies\Annotations\AnnotationParser;
use Mcustiel\SimpleRequest\PropertyParser;
use Mcustiel\SimpleRequest\Util\ValidatorBuilder;
use Mcustiel\SimpleRequest\Annotation\AnnotationWithAssociatedClass;

class ValidatorAnnotationParser implements AnnotationParser
{
    public function execute(AnnotationWithAssociatedClass $annotation, PropertyParser $propertyParser)
    {
        $propertyParser->addValidator(
            ValidatorBuilder::builder()
                ->withClass($annotation->getAssociatedClass())
                ->withSpecification($annotation->getValue())
                ->build()
            );
    }
}
