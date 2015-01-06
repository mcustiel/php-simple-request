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

class IPV6 implements ValidatorInterface
{
    const REGEXP_WITHOUT_SHORTCUT = '/^(?:[0-9a-f]{1,4})(?::(?:[0-9a-f]{1,4})){7}$/i';
    const REGEXP_SHORTCUT_IN_MIDDLE = '/^(?:[0-9a-f]{1,4})(?::[0-9a-f]{1,4})*::(?:[0-9a-f]{1,4})(?::[0-9a-f]{1,4})*$/i';
    const REGEXP_SHORTCUT_AT_START = '/^::(?:[0-9a-f]{1,4})(?::[0-9a-f]{1,4})*$/i';
    const REGEXP_SHORTCUT_AT_END = '/^(?:[0-9a-f]{1,4})(?::(?:[0-9a-f]{1,4}))*::$/i';

    public function setSpecification($specification = null)
    {
    }

    public function validate($value)
    {
        if (is_string($value)) {
            if (preg_match(self::REGEXP_WITHOUT_SHORTCUT, $value)) {
                return true;
            }

            $count = count(explode(':', $value));
            if (preg_match(self::REGEXP_SHORTCUT_IN_MIDDLE, $value) && $count <= 8) {
                return true;
            }
            if (preg_match(self::REGEXP_SHORTCUT_AT_START, $value) && $count <= 9) {
                return true;
            }
            if (preg_match(self::REGEXP_SHORTCUT_AT_END, $value) && $count <= 9) {
                return true;
            }
        }
        return false;
    }
}
