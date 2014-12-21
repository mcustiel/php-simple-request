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
use Mcustiel\SimpleRequest\Exception\InvalidAnnotationException;
use Mcustiel\SimpleRequest\Annotation\Name;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;
use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleCache\Interfaces\CacheInterface;
use Mcustiel\SimpleCache\Drivers\file\Cache;
use Mcustiel\SimpleCache\Drivers\file\Utils\FileService;
use Mcustiel\SimpleCache\Types\Key;

class RequestBuilder
{
    const DEFAULT_CACHE_PATH = 'php-simple-request/cache/';

    /**
     *
     * @var \Doctrine\Common\Annotations\AnnotationReader
     */
    private $annotationParser;

    /**
     *
     * @var \Mcustiel\SimpleCache\Drivers\file\Cache
     */
    private $cache;

    public function __construct(AnnotationReader $annotationReader = null, \stdClass $cacheConfig = null)
    {
        $this->annotationParser = $annotationReader == null ? new AnnotationReader() : $annotationReader;
        $this->setCache($cacheConfig);
    }

    public function parseRequest(array $request, $className)
    {
        $requestParser = $this->generateRequestParserObject($className);

        return $requestParser->parse($request);
    }

    private function generateCacheName(\ReflectionClass $class, $className)
    {
        $name = $this->annotationParser->getClassAnnotation($class, Name::class);
        if ($name != null) {
            $name = $name->value;
        } else {
            $name = $className;
        }

        return $name;
    }

    private function generateRequestParserObject($className)
    {
        $class = new \ReflectionClass($className);

        $name = $this->generateCacheName($class, $className);

        if ($this->cache === null) {
            return $this->createRequestParser($name, $className, $class);
        }
        return $this->getRequestParserFromCache($name, $className, $class);
    }

    private function getRequestParserFromCache($name, $className, \ReflectionClass $class)
    {
        $key = new Key($name);
        $return = $this->cache->get($key);
        if ($return === null) {
            $return = $this->createRequestParser($name, $className, $class);
            $this->cache->set($key, $return, 0);
        }
        return $return;
    }

    private function createRequestParser($name, $className, \ReflectionClass $class)
    {
        $return = new RequestParser($name);
        $return->setRequestObject($className);
        foreach ($class->getProperties() as $property) {
            $propertyParser = new PropertyParser($property->getName());
            foreach ($this->annotationParser->getPropertyAnnotations($property) as $propertyAnnotation) {
                $this->parsePropertyAnnotation($propertyAnnotation, $propertyParser);
            }
            $return->addProperty($propertyParser);
        }
        return $return;
    }


    private function parsePropertyAnnotation(
        RequestAnnotation $propertyAnnotation,
        PropertyParser $propertyParser)
    {
        if ($propertyAnnotation instanceof RequestAnnotation) {
            $associatedClass = $propertyAnnotation->getAssociatedClass();
            if ($propertyAnnotation instanceof ValidatorAnnotation) {
                $propertyParser->addValidator(
                    FormValidatorBuilder::builder()->withClass($associatedClass)
                        ->withSpecification($propertyAnnotation->value)
                        ->build());
            } elseif ($propertyAnnotation instanceof FilterAnnotation) {
                $propertyParser->addFilter(new $associatedClass());
            }
        }
    }

    private function setCache(\stdClass $cacheConfig = null)
    {
        if ($cacheConfig !== null && isset($cacheConfig->enabled) && $cacheConfig->enabled) {
            $this->cache = new Cache(new FileService(
                isset($cacheConfig->path) ? $cacheConfig->path
                    : sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::DEFAULT_CACHE_PATH
            ));
        }
    }
}
