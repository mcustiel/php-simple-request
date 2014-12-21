<?php
/**
 * This file is part of php-simple-form.
 *
 * php-simple-form is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-simple-form is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with php-simple-form.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Mcustiel\SimpleRequest;

use Doctrine\Common\Annotations\AnnotationReader;
use Mcustiel\SimpleRequest\Util\FormValidatorBuilder;
use Mcustiel\SimpleRequest\Type\Input;
use Mcustiel\SimpleRequest\Type\InputType;
use Mcustiel\SimpleRequest\Type\Form;
use Mcustiel\SimpleRequest\Type\Multiple;
use Mcustiel\SimpleRequest\Exception\InvalidAnnotationException;
use Mcustiel\SimpleRequest\Type\Option;
use Mcustiel\SimpleRequest\Util\FormFilterBuilder;
use Mcustiel\SimpleRequest\Annotation\Name;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;
use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;

class RequestBuilder
{
    /**
     *
     * @var \Doctrine\Common\Annotations\AnnotationReader
     */
    private $annotationParser;

    public function __construct(AnnotationReader $annotationReader = null)
    {
        $this->annotationParser = $annotationReader == null ? new AnnotationReader() : $annotationReader;
    }

    public function parseRequest(array $request, $className)
    {
        $requestParser = $this->generateRequestParserObject($className);

        return $requestParser->parse($request);
    }

    private function generateRequestParserObject($className)
    {
        $class = new \ReflectionClass($className);

        $name = $this->annotationParser->getClassAnnotation($class, Name::class);
        if ($name != null) {
            $name = $name->value;
        }
        $return = new RequestParser($name);
        $return->setRequestObject($className);

        foreach ($class->getProperties() as $property) {
            $propertyParser = new PropertyParser($property->getName());
            foreach ($this->annotationParser->getPropertyAnnotations($property)
                    as $propertyAnnotation) {
                if ($propertyAnnotation instanceof RequestAnnotation) {
                    $associatedClass = $propertyAnnotation->getAssociatedClass();
                    if ($propertyAnnotation instanceof ValidatorAnnotation) {
                        $propertyParser->addValidator(FormValidatorBuilder::builder()
                            ->withClass($associatedClass)
                            ->withSpecification($propertyAnnotation->value)
                            ->build()
                        );
                    } elseif ($propertyAnnotation instanceof FilterAnnotation) {
                        $propertyParser->addFilter(new $associatedClass);
                    }
                }
            }
            $return->addProperty($propertyParser);
        }

        return $return;
    }
}
