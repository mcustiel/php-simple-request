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

abstract class AbstractAnnotationSpecifiedValidator implements ValidatorInterface
{
    protected function checkIfAnnotationAndReturnObject($variable)
    {
        if (!($variable instanceof ValidatorAnnotation)) {
            throw new UnspecifiedValidatorException(
                "The validator is being initialized without a valid array"
            );
        }

        return $this->createValidatorInstanceFromAnnotation($variable);
    }

    /**
     * @param \Mcustiel\SimpleRequest\Annotation\ValidatorAnnotation $validatorAnnotation
     *
     * @return \Mcustiel\SimpleRequest\Interfaces\ValidatorInterface
     */
    protected function createValidatorInstanceFromAnnotation($validatorAnnotation)
    {
        $class = $validatorAnnotation->getAssociatedClass();
        $object = new $class;
        $object->setSpecification($validatorAnnotation->value);

        return $object;
    }

    abstract public function setSpecification($specification = null);

    abstract public function validate($value);
}
