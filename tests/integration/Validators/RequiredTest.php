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
namespace integration\Validators;

class RequiredTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'required';

    public function testBuildARequestWithInvalidValueInAStdClass()
    {
        $class = new \stdClass();
        $class->key1 = 'val1';
        $class->key3 = 'val3';

        $this->request[self::TEST_FIELD] = $class;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidArray()
    {
        $this->request[self::TEST_FIELD] = ['key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3'];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueInAnArray()
    {
        $this->request[self::TEST_FIELD] = ['key1' => 'val1', 'key3' => 'val3'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
