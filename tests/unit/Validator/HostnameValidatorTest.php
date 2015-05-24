<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\HostName;

class HostNameValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new HostName();
        $this->validator->setSpecification();
    }

    public function testSuccessfulValidation()
    {
        $this->assertTrue($this->validator->validate('es.wikipedia.org'));
        $this->assertTrue($this->validator->validate('wikipedia.org'));
        $this->assertTrue($this->validator->validate('4chan.org'));
    }

    public function testUnsuccessfulValidation()
    {
        $this->assertFalse($this->validator->validate('wikipedia'));
        $this->assertFalse($this->validator->validate('es.wikipedia.org/'));
        $this->assertFalse($this->validator->validate('http://es.wikipedia.org'));
        $this->assertFalse($this->validator->validate('.wikipedia.org'));
        $this->assertFalse($this->validator->validate(''));
    }
}
