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
namespace Mcustiel\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Interfaces\ValidatorInterface;
use Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException;
use Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation;

/**
 * This validator is not absolutely clear in json schema validation. I took
 * the idea to implement it from the following article:
 * http://spacetelescope.github.io/understanding-json-schema/UnderstandingJSONSchema.pdf
 *
 * @author mcustiel
 */
class Items extends AbstractIterableValidator
{
    const ITEMS_INDEX = 'properties';
    const ADDITIONAL_ITEMS_INDEX = 'additionalProperties';

    private $additionalItems = true;

    public function setSpecification($specification = null)
    {
        $this->checkSpecificationIsArray($specification);

        if (isset($specification[self::ITEMS_INDEX])) {
            $this->setItems($specification[self::ITEMS_INDEX]);
        }
        if (isset($specification[self::ADDITIONAL_ITEMS_INDEX])) {
            $this->setAdditionalItems($specification[self::ADDITIONAL_ITEMS_INDEX]);
        }
    }

    public function validate($value)
    {
        if (!is_array($value) && ! ($value instanceof \stdClass)) {
            return false;
        }

        // From json-schema definition: if "items" is not present, or its value is an object,
        // validation of the instance always succeeds, regardless of the value of "additionalItems";
        if (empty($this->items)) {
            return true;
        }

        if (!is_array($value)) {
            $value = (array) $value;
        }

        if ($this->items instanceof ValidatorInterface) {
            return $this->validateWithoutAdditionalItemsConcern($value);
        }

        // From json-schema definition: if the value of "additionalItems" is boolean value false and
        // the value of "items" is an array, the instance is valid if its size is less than, or
        // equal to, the size of "items".
        if ($this->additionalItems === false) {
            return (count($value) <= count($this->items))
                && $this->validateTuple($value);
        }

        // From json-schema definition: if the value of "additionalItems" is
        // boolean value true or an object, validation of the instance always succeeds;
        return $this->validateList($value);
    }

    private function validateWithoutAdditionalItemsConcern($array)
    {
        foreach ($array as $value) {
            if (!$this->items->validate($value)) {
                return false;
            }
        }
        return true;
    }

    private function validateList($list)
    {
        if ($this->validateTuple($list)) {
            if ($this->additionalItems === true) {
                return true;
            }

            $keys = (array_keys($this->items));
            $count = count($this->items);
            $array = array_slice($keys, $count, count($list) - $count);
            foreach ($array as $item) {
                if (!$this->additionalItems->validate($item)) {
                    return false;
                }
            }

            return true;
        }
    }

    private function validateTuple($tuple)
    {
        foreach ($this->items as $property => $validator) {
            if (!$validator->validate(isset($tuple[$property]) ? $tuple[$property] : null)) {
                return false;
            }
        }

        return true;
    }

    private function setItems($specification)
    {
        if ($specification instanceof ValidatorAnnotation) {
            $this->items = $this->createValidatorInstanceFromAnnotation(
                $specification
            );
        } elseif (is_array($specification)) {
            foreach ($specification as $key => $item) {
                $this->items[$key] = $this->checkIfAnnotationAndReturnObject($item);
            }
        }
        throw new UnspecifiedValidatorException(
            "The validator is being initialized without a valid array"
        );
    }

    private function setAdditionalItems($specification)
    {
        if (is_bool($specification)) {
            $this->additionalItems = $specification;
        } elseif ($specification instanceof ValidatorAnnotation) {
            $this->additionalItems = $this->createValidatorInstanceFromAnnotation(
                $specification
            );
        }
        throw new UnspecifiedValidatorException(
            "The validator is being initialized without an array"
        );
    }
}
