<?php

namespace Unit\Filter;

abstract class BaseTestForNumericFilters extends \PHPUnit_Framework_TestCase
{
    protected function getVariableInfo($var)
    {
        ob_start();
        var_dump($var);
        $data = ob_get_contents();
        ob_end_clean();

        return $data;
    }
}
