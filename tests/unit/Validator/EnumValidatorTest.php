<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Enum;

class EnumValidatorTest extends \PHPUnit_Framework_TestCase
{
    private static $specification = [ 'potato', 3, 4.0, 5.2, '3.8', '6.0', '9', [ 'data1', 'data2' ] ];
    private $validator;

    public function setUp()
    {
        $this->validator = new Enum();
        $this->validator->setSpecification(self::$specification);
    }

    public function testValidationSuccessful()
    {
        $this->assertTrue($this->validator->validate('potato'));
        $this->assertTrue($this->validator->validate(3));
        $this->assertTrue($this->validator->validate(4.0));
        $this->assertTrue($this->validator->validate(5.2));
        $this->assertTrue($this->validator->validate('5.2'));
        $this->assertTrue($this->validator->validate('3.8'));
        $this->assertTrue($this->validator->validate(3.8));
        $this->assertTrue($this->validator->validate('6.0'));
        $this->assertTrue($this->validator->validate(6.0));
        $this->assertTrue($this->validator->validate(6));
        $this->assertTrue($this->validator->validate('9'));
        $this->assertTrue($this->validator->validate(9));
        $this->assertTrue($this->validator->validate(9.0));
        $this->assertTrue($this->validator->validate([ 'data1', 'data2' ]));
    }

    public function testValidationUnsuccessful()
    {
        $this->assertFalse($this->validator->validate('not exists'));
    }

    /**
     * @expectedException        \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator Enum is being initialized without an array
     */
    public function shouldThrowExceptionIfSpecificationIsNotArray()
    {
        $this->validator->setSpecification('nope');
    }

    /**
     * @expectedException        \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator Enum is being initialized without an array
     */
    public function shouldThrowExceptionIfSpecificationIsEmptyArray()
    {
        $this->validator->setSpecification([]);
    }
}
