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
use Mcustiel\SimpleRequest\Util\ValidatorBuilder;
use Mcustiel\SimpleRequest\Exception\InvalidAnnotationException;
use Mcustiel\SimpleRequest\Annotation\RequestAnnotation;
use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;
use Mcustiel\SimpleCache\Interfaces\CacheInterface;
use Mcustiel\SimpleCache\Drivers\file\Cache;
use Mcustiel\SimpleCache\Drivers\file\Utils\FileService;
use Mcustiel\SimpleCache\Types\Key;
use Mcustiel\SimpleRequest\Util\FilterBuilder;

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

    public function __construct(\stdClass $cacheConfig = null, AnnotationReader $annotationReader = null)
    {
        $this->annotationParser = $annotationReader == null ? new AnnotationReader() : $annotationReader;
        $this->setCache($cacheConfig);
    }

    public function parseRequest(array $request, $className)
    {
        $requestParser = $this->generateRequestParserObject($className);

        return $requestParser->parse($request);
    }

    public function getErrors(RequestParser $parser)
    {
        return $parser->getInvalidValues();
    }

    private function generateRequestParserObject($className)
    {
        $class = new \ReflectionClass($className);
        $name = str_replace('\\', '', $className);

        if ($this->cache === null) {
            return $this->createRequestParser($name, $className, $class);
        }

        return  $this->getRequestParserFromCache($name, $className, $class);
    }

    private function getRequestParserFromCache($name, $className, \ReflectionClass $class)
    {
        $fileName = $this->cache . $name;
        if (!file_exists($fileName)) {
            $return = $this->createRequestParser($name, $className, $class);
            if (!is_dir($this->cache)) {
                mkdir($this->cache, 0777, true);
            }
            file_put_contents($fileName, serialize($return));
            return $return;
        }

        return unserialize(file_get_contents($fileName));
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
                $propertyParser->addValidator(ValidatorBuilder::builder()
                    ->withClass($associatedClass)
                    ->withSpecification($propertyAnnotation->value)
                    ->build()
                );
            } elseif ($propertyAnnotation instanceof FilterAnnotation) {
                $propertyParser->addFilter(FilterBuilder::builder()
                    ->withClass($associatedClass)
                    ->withSpecification($propertyAnnotation->value)
                    ->build()
                );
            }
        }
    }

    private function setCache(\stdClass $cacheConfig = null)
    {
        if ($cacheConfig !== null) {
            if (isset($cacheConfig->disabled) && $cacheConfig->disabled) {
                return null;
            }
            $this->cache =
                isset($cacheConfig->path) ? $cacheConfig->path
                    : sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::DEFAULT_CACHE_PATH
            ;
        }
        $this->cache = sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::DEFAULT_CACHE_PATH;
    }
}
