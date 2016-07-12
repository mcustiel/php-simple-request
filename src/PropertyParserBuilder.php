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
class PropertyParserBuilder
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
    private $propertyName;
    /**
     *
     * @var string
     */
    private $propertyType;

    /**
     * Class constructor. Initialized with the property name.
     *
     * @param string $name
     */
    private function __construct($name)
    {
        $this->validators = [];
        $this->filters = [];
        $this->propertyType = null;
        $this->propertyName = $name;
    }

    /**
     * @param string $name
     * @return \Mcustiel\SimpleRequest\PropertyParser
     */
    public function create($name)
    {
        return new self($name);
    }

    /**
     * Adds a validator to the parser.
     *
     * @param \Mcustiel\SimpleRequest\Interfaces\ValidatorInterface $validator
     */
    public function withValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * Adds a filter to the parser.
     *
     * @param \Mcustiel\SimpleRequest\Interfaces\FilterInterface $filter
     */
    public function withFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     *
     * @param string $type
     */
    public function withType($type)
    {
        $this->propertyType = $type;
        return $this;
    }

    public function build()
    {
    }
}
