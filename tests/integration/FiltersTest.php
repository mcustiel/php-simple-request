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
namespace Integration;

use Fixtures\AllFiltersRequest;
use Mcustiel\SimpleRequest\AllErrorsRequestParser;

class FiltersTest extends TestRequestBuilder
{
    const TEST_VALUE = 'test ONE Two';

    private $request;

    /**
     * @before
     */
    public function prepare()
    {
        $this->request = [
            'custom' => self::TEST_VALUE,
            'capitalize' => self::TEST_VALUE,
            'upperCase' => self::TEST_VALUE,
            'lowerCase' => self::TEST_VALUE
        ];
    }

    public function testBuildARequestAndFilters()
    {
        $request = $this->builderWithoutCache->parseRequest(
            $this->request,
            AllFiltersRequest::class,
            new AllErrorsRequestParser()
        );

        $this->assertInstanceOf(AllFiltersRequest::class, $request);
        $this->assertEquals('Test One Two', $request->getCustom());
        $this->assertEquals('Test one two', $request->getCapitalize());
        $this->assertEquals('TEST ONE TWO', $request->getUpperCase());
        $this->assertEquals('test one two', $request->getLowerCase());
    }
}
