<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\Url;

class UrlAccountValidatorTest extends \PHPUnit_Framework_TestCase
{
    const VALID_VALUE_1 = 'http://some.host.com';
    const VALID_VALUE_2 = 'https://some.host.com';
    const VALID_VALUE_3 = 'some.host.com';
    const VALID_VALUE_4 = 'localhost';
    const VALID_VALUE_5 = 'http://some.host.com/subdir/';
    const VALID_VALUE_6 = 'http://some.host.com/subdir/file.php';
    const VALID_VALUE_7 = 'http://some.host.com/subdir/file.php#';
    const VALID_VALUE_8 = 'http://some.host.com/subdir/file.php#anchor';
    const VALID_VALUE_9 = 'http://some.host.com/subdir/file.php?';
    const VALID_VALUE_0 = 'http://some.host.com/subdir/file.php?query=string';
    const INVALID_VALUE = '-:ht:/s//1234.p,s';

    public function testValidation()
    {
        $validator = new Url();
        $validator->setSpecification();

        $this->assertTrue($validator->validate(self::VALID_VALUE_1));
        $this->assertTrue($validator->validate(self::VALID_VALUE_2));
        $this->assertTrue($validator->validate(self::VALID_VALUE_3));
        $this->assertTrue($validator->validate(self::VALID_VALUE_4));
        $this->assertTrue($validator->validate(self::VALID_VALUE_5));
        $this->assertTrue($validator->validate(self::VALID_VALUE_6));
        $this->assertTrue($validator->validate(self::VALID_VALUE_7));
        $this->assertTrue($validator->validate(self::VALID_VALUE_8));
        $this->assertTrue($validator->validate(self::VALID_VALUE_9));
        $this->assertTrue($validator->validate(self::VALID_VALUE_0));
        $this->assertFalse($validator->validate(self::INVALID_VALUE));
    }
}
