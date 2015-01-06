<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\TwitterAccount;

class TwitterAccountValidatorTest extends \PHPUnit_Framework_TestCase
{
    const VALID_VALUE = '@twitterAcc_12';
    const INVALID_VALUE_TOO_LONG = '@AReallyLongAccnt';
    const VALID_VALUE_LONG_LIMIT_UP = '@AReallyLongAcnt';
    const VALID_VALUE_LONG_LIMIT_DOWN = '@a';
    const INVALID_VALUE_ONLY_AT = '@';
    const INVALID_VALUE_ONLY_WORD_CHARS = 'B12';

    public function testValidationWithValidValues()
    {
        $validator = new TwitterAccount();
        $validator->setSpecification();
        $this->assertTrue($validator->validate(self::VALID_VALUE));
        $this->assertTrue($validator->validate(self::VALID_VALUE_LONG_LIMIT_DOWN));
        $this->assertTrue($validator->validate(self::VALID_VALUE_LONG_LIMIT_UP));
    }

    public function testValidationWithInvalidValues()
    {
        $validator = new TwitterAccount();
        $validator->setSpecification();
        $this->assertFalse($validator->validate(self::INVALID_VALUE_ONLY_AT));
        $this->assertFalse($validator->validate(self::INVALID_VALUE_ONLY_WORD_CHARS));
        $this->assertFalse($validator->validate(self::INVALID_VALUE_TOO_LONG));
    }
}
