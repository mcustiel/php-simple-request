<?php
namespace Mcustiel\SimpleRequest;

use Mcustiel\SimpleRequest\Interfaces\ValidatorInterface;
use Mcustiel\SimpleRequest\Interfaces\FilterInterface;
use Mcustiel\SimpleRequest\Exception\InvalidValueException;

class PropertyParser
{
    private $validators;
    private $filters;
    private $name;

    public function __construct($name)
    {
        $this->validators = [];
        $this->filters = [];
        $this->name = $name;
    }

    public function addValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
    }

    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    public function getName()
    {
        return $this->name;
    }

    public function parse($value)
    {
        $return = $this->runFilters($value);
        $this->validate($return);

        return $return;
    }

    private function validate($value)
    {
        $valid = true;
        foreach ($this->validators as $validator) {
            $valid = $valid && $validator->validate($value);
        }
        if (! $valid) {
            throw new InvalidValueException(
                "Field {$this->name}, was set with invalid value: " . var_export($value, true)
            );
        }
    }

    private function runFilters($value)
    {
        $return = $value;
        if ($return !== null) {
            foreach ($this->filters as $filter) {
                $return = $filter->filter($return);
            }
        }

        return $return;
    }

}
