<?php
namespace Integration;

use Mcustiel\SimpleRequest\RequestBuilder;
use Fixtures\PersonRequest;

class PerformanceTest extends \PHPUnit_Framework_TestCase
{
    public function testRequestBuilderWithoutCacheUsingFirstErrorParser()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $config = new \stdClass;
        $config->disabled = true;
        $builder = new RequestBuilder($config);

        $cyclesList = [
            5000
        ];

        foreach ($cyclesList as $cycles) {
            $start = microtime(true);
            for ($i = $cycles; $i > 0; $i --) {
                $personRequest = $builder->parseRequest($request, PersonRequest::class);
            }
            echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
                . " seconds without cache and FIRST_ERROR_PARSER \n";
        }
    }

    public function testRequestBuilderWithCacheUsingFirstErrorParser()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $config = new \stdClass;
        $config->path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-simple-request/cache/';
        $builder = new RequestBuilder($config);

        $cyclesList = [
            25000
        ];

        foreach ($cyclesList as $cycles) {
            $start = microtime(true);
            for ($i = $cycles; $i > 0; $i --) {
                $personRequest = $builder->parseRequest($request, PersonRequest::class);
            }
            echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
                . " seconds with cache and FIRST_ERROR_PARSER \n";
        }
    }

    public function testRequestBuilderWithoutCacheUsingAllErrorsParser()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $config = new \stdClass;
        $config->disabled = true;
        $builder = new RequestBuilder($config);

        $cyclesList = [
            5000
        ];

        foreach ($cyclesList as $cycles) {
            $start = microtime(true);
            for ($i = $cycles; $i > 0; $i --) {
                $personRequest = $builder->parseRequest(
                    $request,
                    PersonRequest::class,
                    RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
                );
            }
            echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
            . " seconds without cache and RETURN_ALL_ERRORS_IN_EXCEPTION \n";
        }
    }

    public function testRequestBuilderWithCacheUsingAllErrorsParser()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $config = new \stdClass;
        $config->path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-simple-request/cache/';
        $builder = new RequestBuilder($config);

        $cyclesList = [
            25000
        ];

        foreach ($cyclesList as $cycles) {
            $start = microtime(true);
            for ($i = $cycles; $i > 0; $i --) {
                $personRequest = $builder->parseRequest(
                    $request,
                    PersonRequest::class,
                    RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
                );
            }
            echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
            . " seconds with cache and RETURN_ALL_ERRORS_IN_EXCEPTION \n";
        }
    }
}
