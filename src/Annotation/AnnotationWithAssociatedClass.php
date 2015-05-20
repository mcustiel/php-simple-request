<?php
namespace Mcustiel\SimpleRequest\Annotation;

class AnnotationWithAssociatedClass extends RequestAnnotation
{
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