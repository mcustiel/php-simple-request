<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class CustomValidator extends ValidatorAnnotation
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
