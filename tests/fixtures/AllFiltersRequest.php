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
namespace Fixtures;

use Mcustiel\SimpleRequest\Annotation\Filter\Capitalize;
use Mcustiel\SimpleRequest\Annotation\Filter\CustomFilter;
use Mcustiel\SimpleRequest\Annotation\Filter\LowerCase;
use Mcustiel\SimpleRequest\Annotation\Filter\UpperCase;

/**
 * @author mcustiel
 */
class AllFiltersRequest
{
    /**
     * @Capitalize
     */
    private $capitalize;

    /**
     * @CustomFilter(class="Mcustiel\SimpleRequest\Filter\Capitalize", value=true)
     *
     * @var unknown
     */
    private $custom;

    /**
     * @LowerCase
     * @var unknown
     */
    private $lowerCase;

    /**
     * @UpperCase
     * @var unknown
     */
    private $upperCase;

    public function getCapitalize()
    {
        return $this->capitalize;
    }

    public function setCapitalize($capitalize)
    {
        $this->capitalize = $capitalize;
        return $this;
    }

    public function getCustom()
    {
        return $this->custom;
    }

    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
    }

    public function getLowerCase()
    {
        return $this->lowerCase;
    }

    public function setLowerCase($lowerCase)
    {
        $this->lowerCase = $lowerCase;
        return $this;
    }

    public function getUpperCase()
    {
        return $this->upperCase;
    }

    public function setUpperCase($upperCase)
    {
        $this->upperCase = $upperCase;
        return $this;
    }
}