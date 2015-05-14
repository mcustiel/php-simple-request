<?php
namespace Mcustiel\SimpleRequest\Annotation\Validator;

use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;
use Mcustiel\SimpleRequest\Validator\Items as ItemsValidator;

/**
 * @Annotation
 * @Target({ "PROPERTY", "ANNOTATION" })
 *
 * @author mcustiel
 */
class Items extends ValidatorAnnotation
{
    public $items;
    public $additionalItems;

    public function __construct()
    {
        parent::__construct(ItemsValidator::class);
    }

    public function getValue()
    {
        return ['items' => $this->items, 'additionalItems' => $this->additionalItems];
    }
}
