<?php
/**
 * This file is part of php-simple-request.
 *
 * php-simple-request is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-simple-request is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with php-simple-request.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Mcustiel\SimpleRequest;

use Mcustiel\SimpleRequest\Interfaces\ValidatorInterface;
use Mcustiel\SimpleRequest\Interfaces\FilterInterface;
use Mcustiel\SimpleRequest\Exception\InvalidValueException;
use Mcustiel\SimpleRequest\Exception\InvalidAnnotationException;

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
     * @var \Mcustiel\SimpleRequest\Interfaces\FilterInterface[]
     */
    private $filters;
    /**
     *
     * @var string
     */
    private $name;
    /**
     *
     * @var string
     */
    private $type;

    /**
     * Class constructor. Initialized with the property name.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->validators = [];
        $this->filters = [];
        $this->type = null;
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
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Filters and validates a value. And return the filtered value.
     * It throws an exception if the value is not valid.
     *
     * @param mixed $value
     * @return mixed
     *
     * @throws \Mcustiel\SimpleRequest\Exception\InvalidValueException
     */
    public function parse($value)
    {
        $return = $this->cloneValue($value);
        /*if ($this->type !== null) {
            $return = $this->createInstanceOfTypeFromValue($return);
        }*/
        $return = $this->runFilters($return);
        $this->validate($return);

        return $return;
    }

    private function cloneValue($value)
    {
        if (is_object($value)) {
            return clone $value;
        }
        return $value;
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

    /**
     * Parses the value as it is an instance of the class specified in type property.
     *
     * @param array|\stdClass $value The value to parse and convert to an object
     *
     * @throws \Mcustiel\SimpleRequest\Exception\InvalidAnnotationException
     * @return object Parsed value as instance of class specified in type property
     */
    private function createInstanceOfTypeFromValue($value)
    {
        if ($value === null) {
            return null;
        }
        if (class_exists($this->type)) {
            return $this->requestBuilder->parseRequest($value, $this->type);
        }
        throw new InvalidAnnotationException(
            "Class {$this->type} does not exist. Annotated in property {$this->name}."
        );
    }
}
