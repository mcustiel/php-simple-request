<?php
namespace Mcustiel\SimpleRequest;

use Mcustiel\SimpleRequest\Interfaces\ValidatorInterface;
use Mcustiel\SimpleRequest\Interfaces\FilterInterface;
use Mcustiel\SimpleRequest\Exception\InvalidValueException;

/**
 * Utility class used to parse the value of a property.
 * It contains all filters and validators specified for the aforementioned property.
 *
 * @author mcustiel
 */
class PropertyParser
{
    /**
     *
     * @var \Mcustiel\SimpleRequest\Interfaces\ValidatorInterface[]
     */
    private $validators;
    /**
     *
     * @var \Mcustiel\SimpleRequest\Interfaces\FilterInterface
     */
    private $filters;
    /**
     *
     * @var string
     */
    private $name;

    /**
     * Class constructor. Initialized with the property name.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->validators = [];
        $this->filters = [];
        $this->name = $name;
    }

    /**
     * Adds a validator to the parser.
     *
     * @param \Mcustiel\SimpleRequest\Interfaces\ValidatorInterface $validator
     */
    public function addValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
    }

    /**
     * Adds a filter to the parser.
     *
     * @param \Mcustiel\SimpleRequest\Interfaces\FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * Returns the name of the property.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Filters and validates a value. And return the filtered value.
     * It throws an exception if the value is not valid.
     *
     * @param mixed $value
     * @return mixed
     * @throws \Mcustiel\SimpleRequest\Exception\InvalidValueException
     */
    public function parse($value)
    {
        $return = $this->runFilters($value);
        $this->validate($return);

        return $return;
    }

    /**
     * Checks the value against all validators.
     *
     * @param mixed $value
     *
     * @throws \Mcustiel\SimpleRequest\Exception\InvalidValueException
     */
    private function validate($value)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($value)) {
                throw new InvalidValueException(
                    "Field {$this->name}, was set with invalid value: " . var_export($value, true)
                );
            }
        }
    }

    /**
     * Run all the filters on the value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
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
