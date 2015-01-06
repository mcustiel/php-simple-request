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
namespace Mcustiel\SimpleRequest\Util;

use Mcustiel\SimpleRequest\Exception\ValidatorDoesNotExist;
use Mcustiel\SimpleRequest\Interfaces\ValidatorInterface;

class ValidatorBuilder
{
    use AnnotationToImplementationBuilder;

    final protected function getClassForType($type)
    {
        if (!class_exists($type)) {
            throw new ValidatorDoesNotExist("Validator class {$type} does not exist");
        }
        $validator = new $type;
        if (! ($validator instanceof ValidatorInterface)) {
            throw new ValidatorDoesNotExist(
                "Validator class {$type} must implement " . ValidatorInterface::class
            );
        }
        return $validator;
    }
}