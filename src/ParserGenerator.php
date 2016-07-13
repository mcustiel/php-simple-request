<?php
/**
 * This file is part of php-simple-request.
 *
 * php-simple-request is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-simple-request is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with php-simple-request.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Mcustiel\SimpleRequest;

use Doctrine\Common\Annotations\AnnotationReader;
use Mcustiel\SimpleRequest\Strategies\AnnotationParserFactory;
use Mcustiel\SimpleRequest\Strategies\PropertyParserBuilder;
use Mcustiel\SimpleRequest\Strategies\Properties\PropertyParser;

class ParserGenerator
{
    /**
     * @var \Doctrine\Common\Annotations\AnnotationReader
     */
    private $annotationReader;
    /**
     * @var \Mcustiel\SimpleRequest\Strategies\AnnotationParserFactory
     */
    private $annotationParserFactory;

    /**
     * @param \Doctrine\Common\Annotations\AnnotationReader $annotationReader
     *                                                                        External annotation reader instance (mostly for DI in tests). Created
     *                                                                        if not is set.
     */
    public function __construct(
        AnnotationReader $annotationReader,
        AnnotationParserFactory $annotationParserFactory
    ) {
        $this->annotationReader = $annotationReader;
        $this->annotationParserFactory = $annotationParserFactory;
    }

    public function addPropertyParser(PropertyParser $propertyParser)
    {
        $this->propertyParsers[] = $propertyParser;
    }

    public function createRequestParser(
        $className,
        $parserObject,
        RequestBuilder $requestBuilder
    ) {
        $class = new \ReflectionClass($className);
        $parserObject->setRequestObject(new $className);
        foreach ($class->getProperties() as $property) {
            $propertyParserBuilder = new PropertyParserBuilder($property->getName());
            foreach ($this->annotationReader->getPropertyAnnotations($property) as $propertyAnnotation) {
                $this->annotationParserFactory
                    ->getAnnotationParserFor($propertyAnnotation)
                    ->execute($propertyAnnotation, $propertyParserBuilder);
            }
            $parserObject->addPropertyParser($propertyParserBuilder->build($requestBuilder));
        }
        return $parserObject;
    }
}
