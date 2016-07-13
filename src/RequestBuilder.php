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
use Psr\Cache\CacheItemPoolInterface as PsrCache;

/**
 * Builds a request by parsing all the resulting object's annotations and running
 * obtained filters and validators against the request.
 *
 * @author mcustiel
 */
class RequestBuilder
{
    /**
     * @var \Psr\Cache\CacheItemPoolInterface
     */
    private $cache;
    /**
     * @var ParserGenerator
     */
    private $parserGenerator;

    /**
     * Class constructor.
     *
     * @param \stdClass $cacheConfig
     *                               Config parameters for cache. By default cache is activated and saves files
     *                               under system's temp dir. This parameter is used to set alternative options.
     *
     */
    public function __construct(
        PsrCache $cache,
        ParserGenerator $parserGenerator
    ) {
        $this->cache = $cache;
        $this->parserGenerator = $parserGenerator;
    }

    /**
     * Main method of this class. Used to convert a request to an object of a given class by
     * using a requestParser.
     *
     * @param array|\stdClass $request   The request to convert to an object.
     * @param string          $className The class of the object to which the request must be converted.
     * @param string          $behaviour The behaviour of the parser.
     */
    public function parseRequest(
        $request,
        $className,
        RequestParser $requestParser
    ) {
        return $this->generateRequestParserObject($className, $requestParser)
            ->parse($this->sanitizeRequestOrThrowExceptionIfInvalid($request));
    }

    private function generateRequestParserObject($className, $parser)
    {
        $cacheKey = str_replace('\\', '', $className . get_class($parser));
        $cacheItem = $this->cache->getItem($cacheKey);
        $return = $cacheItem->get();
        if ($return === null) {
            $return = $this->parserGenerator->createRequestParser($className, $parser, $this);
            $cacheItem->set($return);
            $this->cache->save($cacheItem);
        }

        return $return;
    }

    private function sanitizeRequestOrThrowExceptionIfInvalid($request)
    {
        $isObject = ($request instanceof \stdClass);
        if (!is_array($request) && !$isObject) {
            throw new InvalidRequestException(
                'Request builder is intended to be used with arrays or instances of \\stdClass'
            );
        }
        return $isObject ? json_decode(json_encode($request), true) : $request;
    }
}
