<?php
namespace Mcustiel\SimpleRequest\Annotation;

abstract class RequestAnnotation
{
    public $value;

    public function getValue()
    {
        return $this->value;
    }
}
