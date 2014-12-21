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
namespace Mcustiel\SimpleRequest\Util;

class FormFilterBuilder
{
    private $type;
    private $specification;

    public function withClass($type)
    {
        $this->type = $type;
    }

    public function withSpecification($specification)
    {
        $this->specification = $specification;
    }

    private function getClassForType($type)
    {
        if (!class_exists($this->type)) {
            // throw FilterDoesNotExist exception
        }
        return new $this->type;
    }

    public function build()
    {
        $filter = new $this->getClassForType($this->type);
        $filter->setSpecification($this->specification);
        return $filter;
    }
}
