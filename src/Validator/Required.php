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

class Required implements ValidatorInterface
{
    protected $items;

    public function setSpecification($specification = null)
    {
        if (!is_array($specification)) {
            throw new UnspecifiedValidatorException(
                "The validator Required is being initialized without an array"
            );
        }
        foreach ($specification as $item) {
            if (!is_string($item) || is_numeric($item)) {
                throw new UnspecifiedValidatorException(
                    "The validator Required is being initialized without a valid array"
                );
            }
        }
        $this->items = $specification;
    }

    public function validate($value)
    {
        if (!$value instanceof \stdClass) {
            return false;
        }

        foreach ($this->items as $item) {
            if (!property_exists($value, $item)) {
                return false;
            }
        }

        return true;
    }
}
