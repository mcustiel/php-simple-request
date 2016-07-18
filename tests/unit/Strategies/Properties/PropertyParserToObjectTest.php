<?php
namespace Unit\Strategies\Properties;

use Mcustiel\SimpleRequest\Strategies\Properties\PropertyParserToObject;
use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Symfony\Component\Cache\Adapter\NullAdapter;
use Mcustiel\SimpleRequest\ParserGenerator;
use Doctrine\Common\Annotations\AnnotationReader;
use Mcustiel\SimpleRequest\Strategies\AnnotationParserFactory;

class PropertyParserToObjectTest extends \PHPUnit_Framework_TestCase
{
    private $requestBuilder;

    /**
     * @before
     */
    public function constructBuilder()
    {
        $this->requestBuilder = new RequestBuilder(
            new NullAdapter(),
            new ParserGenerator(
                new AnnotationReader(),
                new AnnotationParserFactory()
            )
        );
    }

    /**
     * @test
     */
    public function nullIfObjectNotSet()
    {
        $property = new PropertyParserToObject('test', AllValidatorsRequest::class, $this->requestBuilder);
        $this->assertNull($property->parse(null));
    }

    /**
     * @test
     * @expectedException \Mcustiel\SimpleRequest\Exception\InvalidAnnotationException
     * @expectedExceptionMessage Class ThisClass\DoesNot\Exist does not exist. Annotated in property test.
     */
    public function failIfClassDoesNotExist()
    {
        $property = new PropertyParserToObject('test', 'ThisClass\DoesNot\Exist', $this->requestBuilder);
        $this->assertNull($property->parse(['a' => 'class']));
    }
}
