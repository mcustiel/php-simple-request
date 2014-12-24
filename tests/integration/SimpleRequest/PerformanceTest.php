<?php
namespace Integration\SimpleRequest;

use Mcustiel\SimpleRequest\RequestBuilder;
use Fixtures\PersonRequest;

class PerformanceTest extends \PHPUnit_Framework_TestCase
{
    public function testRequestBuilderWithoutCache()
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
            1000
        ];

        foreach ($cyclesList as $cycles) {
            $start = microtime(true);
            for ($i = $cycles; $i > 0; $i --) {
                $personRequest = $builder->parseRequest($request, PersonRequest::class);
            }
            echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
                . " seconds without cache \n";
        }
    }

    public function testRequestBuilderWithCache()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $config = new \stdClass;
        $config->path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-simple-request/cache/';
        $builder = new RequestBuilder();

        $cyclesList = [
            10000
        ];

        foreach ($cyclesList as $cycles) {
            $start = microtime(true);
            for ($i = $cycles; $i > 0; $i --) {
                $personRequest = $builder->parseRequest($request, PersonRequest::class);
            }
            echo "\n{$cycles} cycles executed in " . (microtime(true) - $start)
                . " seconds with cache \n";
        }
    }
}
