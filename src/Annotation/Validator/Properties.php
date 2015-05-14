<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Properties as PropertiesValidator;
use Mcustiel\SimpleRequest\Exception\InvalidAnnotationException;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class Properties extends ValidatorAnnotation
{
    public $properties;
    public $additionalProperties;

    public function __construct()
    {
        parent::__construct(PropertiesValidator::class);
    }

    public function getValue()
    {
        $count = count($this->properties);

        if ($count % 2 != 0) {
            throw InvalidAnnotationException(
                "Properties field must specify a set of (name, validator) pairs"
            );
        }

        $properties = array();
        for ($i = 0; $i < $count; $i += 2) {
            $properties[$this->properties[$i]] = $this->properties[$i + 1];
        }

        return ['properties' => $properties, 'additionalProperties' => $this->additionalProperties];
    }
}
