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
namespace Integration;

use Fixtures\PersonRequest;
use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\Exception\InvalidRequestException;
use Fixtures\CoupleRequest;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\NullAdapter;
use Mcustiel\SimpleRequest\ParserGenerator;
use Doctrine\Common\Annotations\AnnotationReader;
use Mcustiel\SimpleRequest\Strategies\AnnotationParserFactory;

abstract class TestRequestBuilder extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \Mcustiel\SimpleRequest\RequestBuilder
     */
    protected $builderWithCache;
    /**
     *
     * @var \Mcustiel\SimpleRequest\RequestBuilder
     */
    protected $builderWithoutCache;

    /**
     * @before
     */
    public function initBuilders()
    {
        $this->builderWithCache = $this->createCachedRequestBuilder();
        $this->builderWithoutCache = new RequestBuilder(
            new NullAdapter(),
            new ParserGenerator(new AnnotationReader(), new AnnotationParserFactory())
        );
    }

    protected function createCachedRequestBuilder($namespace = 'PhpSimpleRequestTest')
    {
        return new RequestBuilder(
            new FilesystemAdapter($namespace),
            new ParserGenerator(new AnnotationReader(), new AnnotationParserFactory())
        );
    }

    protected function assertPersonIsOk($personRequest)
    {
        $this->assertInstanceOf(PersonRequest::class, $personRequest);
        $this->assertEquals('John', $personRequest->getFirstName());
        $this->assertEquals('DOE', $personRequest->getLastName());
        $this->assertEquals(30, $personRequest->getAge());
    }
}
