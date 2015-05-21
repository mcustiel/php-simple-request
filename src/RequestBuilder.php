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

use Mcustiel\SimpleRequest\Exception\InvalidRequestException;

/**
 * Builds a request by parsing all the resulting object's annotations and running
 * obtained filters and validators against the request.
 *
 * @author mcustiel
 */
class RequestBuilder
{
    const RETURN_ALL_ERRORS_IN_EXCEPTION = 'AllErrorsRequestParser';
    const THROW_EXCEPTION_ON_FIRST_ERROR = 'FirstErrorRequestParser';
    const DEFAULT_CACHE_PATH = 'php-simple-request/cache/';

    /**
     *
     * @var \Mcustiel\SimpleCache\Drivers\file\Cache
     */
    private $cache;
    /**
     *
     * @var ParserGenerator
     */
    private $parserGenerator;

    /**
     * Class constructor.
     *
     * @param \stdClass        $cacheConfig
     *      Config parameters for cache. By default cache is activated and saves files
     *      under system's temp dir. This parameter is used to set alternative options.
     *
     */
    public function __construct(
        \stdClass $cacheConfig = null,
        ParserGenerator $parserGenerator = null
    ) {
        $this->setCache($cacheConfig);
        $this->parserGenerator = $parserGenerator === null ? new ParserGenerator($this) : $parserGenerator;
    }

    /**
     * Main method of this class. Used to convert a request to an object of a given class by
     * using a requestParser.
     *
     * @param array|\stdClass  $request   The request to convert to an object.
     * @param string           $className The class of the object to which the request must be converted.
     * @param string           $behaviour The behaviour of the parser.
     */
    public function parseRequest(
        $request,
        $className,
        $behaviour = self::THROW_EXCEPTION_ON_FIRST_ERROR
    ) {
        $this->checkRequestType($request);

        $requestParser = $this->generateRequestParserObject(
            $className,
            '\\Mcustiel\\SimpleRequest\\' . $behaviour
        );

        return $requestParser->parse($request);
    }

    private function generateRequestParserObject($className, $parserClass)
    {
        $class = new \ReflectionClass($className);
        $name = str_replace('\\', '', $className . $parserClass);

        if ($this->cache === null) {
            return $this->parserGenerator->createRequestParser($name, $className, $class, $parserClass);
        }

        return  $this->getRequestParserFromCache($name, $className, $class, $parserClass);
    }

    private function getRequestParserFromCache($name, $className, \ReflectionClass $class, $parserClass)
    {
        $fileName = $this->cache . $name;
        if (!file_exists($fileName)) {
            $return = $this->parserGenerator->createRequestParser($name, $className, $class, $parserClass);
            if (!is_dir($this->cache)) {
                mkdir($this->cache, 0777, true);
            }
            file_put_contents($fileName, serialize($return));

            return $return;
        }

        return unserialize(file_get_contents($fileName));
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
            return;
        }
        $this->cache = sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::DEFAULT_CACHE_PATH;
    }

    private function checkRequestType($request)
    {
        if (!is_array($request) && ! ($request instanceof \stdClass)) {
            throw new InvalidRequestException(
                'Request builder is intended to be used with arrays or instances of \\stdClass'
            );
        }
    }
}
