<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\UniqueItems;

class UniqueItemsValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new UniqueItems();
        $this->validator->setSpecification();
    }

    public function testSuccessfultValidation()
    {
        $this->assertTrue($this->validator->validate([]));
        $this->assertTrue($this->validator->validate([1, 2, 3]));
        $this->assertTrue($this->validator->validate(['a', 'b', 'c']));
        $this->assertTrue($this->validator->validate([1, 'b', 3]));

    }

    public function testUnsuccessfulValidation()
    {
        $this->assertFalse($this->validator->validate([1, 2, 3, 3]));
        $this->assertFalse($this->validator->validate([1, 2, 2.0, 3]));
    }
}
