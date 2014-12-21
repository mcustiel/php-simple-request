<?php
/**
 * This file is part of php-simple-form.
 *
 * php-simple-form is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-simple-form is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with php-simple-form.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Mcustiel\SimpleRequest\Validator;

class Date implements ValidatorInterface
{
    private $specification;

    public function setSpecification($specification = null)
    {
        $this->specification = $specification == null ? 'Y-m-d H:i:sO' : $specification;
    }

    public function validate($value)
    {
        $date = \DateTime::createFromFormat($this->specification, $value);

        return $date !== false && \DateTime::getLastErrors()['error_count'] == 0;
    }
}
