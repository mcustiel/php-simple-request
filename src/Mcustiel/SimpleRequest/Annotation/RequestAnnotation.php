<?php
namespace Mcustiel\SimpleRequest\Annotation;

abstract class RequestAnnotation
{
    public $value;
    private $associatedClass;

    protected function __construct($associatedClass)
    {
        $this->associatedClass = $associatedClass;
    }

    public function getAssociatedClass()
    {
        return $this->associatedClass;
    }
}
