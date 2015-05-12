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
    const ITEMS_INDEX = 'items';
    const ADDITIONAL_ITEMS_INDEX = 'additionalItems';

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
        if (!is_array($value)) {
            return false;
        }

        // From json-schema definition: if "items" is not present, or its value is an object,
        // validation of the instance always succeeds, regardless of the value of "additionalItems";
        if (empty($this->items)) {
            return true;
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
        $count = count($this->items);
        return $this->validateTuple($list) && (
            $this->additionalItems === true ||
            $this->validateArray(
                array_slice($list, $count, count($list) - $count, $this->additionalItems)
            )
        );
    }

    private function validateTuple($tuple)
    {
        $keys = array_keys($tuple);
        $index = 0;
        $count = count($this->items);
        for ($index = 0; $index < $count; $index++) {
            $validator = $this->items[$index];
            // In the specification is not clear what to do when instance size
            // is less than items size. I chose to pass null and if null passes
            // the validation, it returns true.
            if (
                !$validator->validate(isset($tuple[$keys[$index]]) ? $tuple[$keys[$index]] : null)
            ) {
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
        } else {
            parent::setSpecification($specification);
        }
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
    }

    private function validateArray(array $array, ValidatorInterface $validator) {
        foreach ($array as $item) {
            if (!$validator->validate($item)) {
                return false;
            }
        }

        return true;
    }
}
