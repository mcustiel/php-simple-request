<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\FilterAnnotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author mcustiel
 */
class Custom extends FilterAnnotation
{
    /**
     *
     * @var string
     */
    public $class;

    public function __construct()
    {
        parent::__construct(null);
    }

    public function getAssociatedClass()
    {
        return $this->class;
    }
}
