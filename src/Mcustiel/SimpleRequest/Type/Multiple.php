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
namespace Mcustiel\SimpleRequest\Type;

use Mcustiel\SimpleRequest\Decorator\Input\BasicMultipleDecoratorSelect;

class Multiple extends Input
{
    /**
     *
     * @var \Mcustiel\SimpleRequest\Type\Option[]
     */
    private $options = [];
    /**
     *
     * @var boolean
     */
    private $multiple;

    public function __construct(Input $other)
    {
        parent::__construct($other->name);
        $this->decorator = new BasicMultipleDecoratorSelect();
        if ($other != null) {
            $this->setProperties($other->getProperties());
        }
        unset($this->type);
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    public function addOption(Option $option)
    {
        $this->options[] = $option;
    }

    public function getMultiple()
    {
        return $this->multiple;
    }

    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
        return $this;
    }
}
