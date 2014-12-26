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

use Mcustiel\SimpleRequest\Exception\FilterDoesNotExist;
use Mcustiel\SimpleRequest\Interfaces\FilterInterface;

class FilterBuilder
{
    use AnnotationToImplementationBuilder;

    protected final function getClassForType($type)
    {
        if (!class_exists($type)) {
            throw new FilterDoesNotExist("Filter class {$type} does not exist");
        }
        $filter = new $type;
        if (! ($filter instanceof FilterInterface)) {
            throw new FilterDoesNotExist(
                "Filter class {$type} must implement " . FilterInterface::class
            );
        }
        return $filter;
    }
}
