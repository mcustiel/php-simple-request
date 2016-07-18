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
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Properties;
use Mcustiel\SimpleRequest\Validator\NotEmpty;

class PropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mcustiel\SimpleRequest\Interfaces\ValidatorInterface
     */
    private $validator;

    /**
     * @before
     */
    public function init()
    {
        $this->validator = new Properties();
    }


    /**
     * @test
     * @expectedException \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator is being initialized without an array
     */
    public function failIfSpecificationIsNotAnArray()
    {
        $this->validator->setSpecification('potato');
    }

    /**
     * @test
     * @expectedException \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator Properties is being initialized with an invalid properties parameter
     */
    public function failIfSpecificationPropertiesIsInvalid()
    {
        $this->validator->setSpecification(['properties' => 'potato']);
    }

    /**
     * @test
     * @expectedException \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator is being initialized without a valid validator Annotation
     */
    public function failIfSpecificationPropertiesIsAnArrayWithoutAnnotation()
    {
        $this->validator->setSpecification(['properties' => [new NotEmpty()]]);
    }

    /**
     * @test
     * @expectedException \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator Properties is being initialized with an invalid additionalProperties parameter
     */
    public function failIfSpecificationAdditionalPropertiesIsInvalid()
    {
        $this->validator->setSpecification(['additionalProperties' => 'potato']);
    }
}
