<?php

namespace Mcustiel\SimpleRequest;

use Doctrine\Common\Annotations\AnnotationReader;
use Mcustiel\SimpleRequest\Util\ValidatorBuilder;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;
use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleRequest\Util\FilterBuilder;
use Mcustiel\SimpleRequest\Annotation\ParseAs;
use Mcustiel\SimpleRequest\Annotation\AnnotationWithAssociatedClass;

class ParserGenerator
{
    /**
     *
     * @var \Doctrine\Common\Annotations\AnnotationReader
     */
    private $annotationParser;
    /**
     *
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     *
     * @param \Doctrine\Common\Annotations\AnnotationReader $annotationReader
     *      External annotation reader instance (mostly for DI in tests). Created
     *      if not is set.
     */
    public function __construct(RequestBuilder $requestBuilder, AnnotationReader $annotationReader = null)
    {
        $this->annotationParser = $annotationReader == null ? new AnnotationReader() : $annotationReader;
        $this->requestBuilder = $requestBuilder;
    }

    public function createRequestParser(
        $name,
        $className,
        \ReflectionClass $class,
        $parserClass
    ) {
        $return = new $parserClass($name);
        $return->setRequestObject($className);
        foreach ($class->getProperties() as $property) {
            $propertyParser = new PropertyParser($property->getName(), $this->requestBuilder);
            foreach ($this->annotationParser->getPropertyAnnotations($property) as $propertyAnnotation) {
                $this->parsePropertyAnnotation($propertyAnnotation, $propertyParser);
            }
            $return->addProperty($propertyParser);
        }
        return $return;
    }

    private function parsePropertyAnnotation(
        RequestAnnotation $propertyAnnotation,
        PropertyParser $propertyParser
    ) {
        if ($propertyAnnotation instanceof AnnotationWithAssociatedClass) {
            $associatedClass = $propertyAnnotation->getAssociatedClass();
            if ($propertyAnnotation instanceof ValidatorAnnotation) {
                $propertyParser->addValidator(
                    ValidatorBuilder::builder()
                    ->withClass($associatedClass)
                    ->withSpecification($propertyAnnotation->getValue())
                    ->build()
                );
            } elseif ($propertyAnnotation instanceof FilterAnnotation) {
                $propertyParser->addFilter(
                    FilterBuilder::builder()
                    ->withClass($associatedClass)
                    ->withSpecification($propertyAnnotation->getValue())
                    ->build()
                );
            }
        } elseif ($propertyAnnotation instanceof ParseAs) {
            $propertyParser->setType($propertyAnnotation->getValue());
        }
    }
}
