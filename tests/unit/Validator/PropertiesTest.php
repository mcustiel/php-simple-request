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
use Mcustiel\SimpleRequest\Annotation\Validator\Type;

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

    /**
     * @test
     */
    public function isNotValidIfNotArrayOrObject()
    {
        $this->assertFalse($this->validator->validate('potato'));
    }

    /**
     * @test
     */
    public function isValidIfItemsEmpty()
    {
        $this->validator->setSpecification(['properties' => []]);
        $matter = 'matter';
        $this->assertTrue($this->validator->validate(['it', ['does' => 'not'], $matter, 1]));
    }

    /**
     * @test
     */
    public function useItemsAsValidatorWithValidValues()
    {
        $validator = new Type();
        $validator->value = 'number';
        $this->validator->setSpecification(['properties' => $validator]);
        $this->assertTrue($this->validator->validate([1, 2, 3.4, 5.67]));
    }

    /**
     * @test
     */
    public function useItemsAsValidatorWithAnInvalidValue()
    {
        $validator = new Type();
        $validator->value = 'number';
        $this->validator->setSpecification(['properties' => $validator]);
        $this->assertFalse($this->validator->validate([1, 2, 3.4, 5.67, 'nope']));
    }

    /**
     * @test
     */
    public function validateASpecificPropertyAgainstAValidator()
    {
        $validator = new Type();
        $validator->value = 'number';
        $this->validator->setSpecification(['properties' => ['potato' => $validator]]);
        $this->assertTrue($this->validator->validate(['does', ['not' => 'matter'], 'potato' => 21]));
    }
}
