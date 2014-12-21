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
namespace Mcustiel\SimpleRequest;

use Doctrine\Common\Annotations\AnnotationReader;
use Mcustiel\SimpleRequest\Exception\InvalidAnnotationException;

class RequestParser
{
    private $properties;
    private $requestObject;

    public function __construct()
    {
        $this->properties = [];
    }

    public function addProperty(PropertyParser $parser)
    {
        $this->properties[$parser->getName()] = $parser;
    }

    public function getRequestObject()
    {
        return new $this->requestObject;
    }

    public function setRequestObject($requestObject)
    {
        $this->requestObject = $requestObject;
    }

    public function parse(array $request)
    {
        $return = new $this->requestObject;
        foreach ($this->properties as $propertyParser) {
            $value = $propertyParser->parse(isset($request[$propertyParser->getName()])
                ? $request[$propertyParser->getName()] : null);
            $method = 'set' . ucfirst($propertyParser->getName());
            $return->$method($value);
        }

        return $return;
    }
}
