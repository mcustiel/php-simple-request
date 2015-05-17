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
use Mcustiel\SimpleRequest\Util\FilterBuilder;

/**
 * Builds a request by parsing all the resulting object's annotations and running
 * obtained filters and validators against the request.
 *
 * @author mcustiel
 */
class RequestBuilder
{
    /**
     * @deprecated Will be deleted in version 2.0. Use RETURN_PARSER_RESPONSE_OBJECT instead
     */
    const ALL_ERRORS_PARSER = 'AllErrorsRequestParser';
    const RETURN_ALL_ERRORS_IN_EXCEPTION = 'AllErrorsRequestParser';
    /**
     *
     * @deprecated Will be deleted in version 2.0. Use THROW_EXCEPTION_ON_FIRST_ERROR instead.
     */
    const FIRST_ERROR_PARSER = 'FirstErrorRequestParser';
    const THROW_EXCEPTION_ON_FIRST_ERROR = 'FirstErrorRequestParser';
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

    /**
     * Class constructor.
     *
     * @param \stdClass        $cacheConfig
     *      Config parameters for cache. By default cache is activated and saves files
     *      under system's temp dir. This parameter is used to set alternative options.
     * @param \Doctrine\Common\Annotations\AnnotationReader $annotationReader
     *      External annotation reader instance (mostly for DI in tests). Created
     *      if not is set.
     */
    public function __construct(
        \stdClass $cacheConfig = null,
        AnnotationReader $annotationReader = null
    ) {
        $this->annotationParser = $annotationReader == null ? new AnnotationReader() : $annotationReader;
        $this->setCache($cacheConfig);
    }

    /**
     * Main method of this class. Used to convert a request to an object of a given class by
     * using a requestParser.
     * @param array  $request   The request to convert to an object.
     * @param string $className The class of the object to which the request must be converted.
     * @param string $behaviour The behaviour of the parser.
     */
    public function parseRequest(
        array $request,
        $className,
        $behaviour = self::THROW_EXCEPTION_ON_FIRST_ERROR
    ) {
        $parserClass = '\\Mcustiel\\SimpleRequest\\' . $behaviour;
        $requestParser = $this->generateRequestParserObject($className, $parserClass);

        return $requestParser->parse($request);
    }

    private function generateRequestParserObject($className, $parserClass)
    {
        $class = new \ReflectionClass($className);
        $name = str_replace('\\', '', $className . $parserClass);

        if ($this->cache === null) {
            return $this->createRequestParser($name, $className, $class, $parserClass);
        }

        return  $this->getRequestParserFromCache($name, $className, $class, $parserClass);
    }

    private function getRequestParserFromCache($name, $className, \ReflectionClass $class, $parserClass)
    {
        $fileName = $this->cache . $name;
        if (!file_exists($fileName)) {
            $return = $this->createRequestParser($name, $className, $class, $parserClass);
            if (!is_dir($this->cache)) {
                mkdir($this->cache, 0777, true);
            }
            file_put_contents($fileName, serialize($return));
            return $return;
        }

        return unserialize(file_get_contents($fileName));
    }

    private function createRequestParser($name, $className, \ReflectionClass $class, $parserClass)
    {
        $return = new $parserClass($name);
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
        PropertyParser $propertyParser
    ) {
        if ($propertyAnnotation instanceof RequestAnnotation) {
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
