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

/**
 * Validates that a given value is a string with ipv6 format.
 *
 * @author mcustiel
 */
class IPV6 implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\SimpleRequest\Interfaces\Specificable::setSpecification()
     */
    public function setSpecification($specification = null)
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see \Mcustiel\SimpleRequest\Interfaces\ValidatorInterface::validate()
     */
    public function validate($value)
    {
        return filter_var($value, FILTER_VALIDATE_IP, ['flags' => FILTER_FLAG_IPV6]) !== false;
    }
}
