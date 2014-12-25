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

use Mcustiel\SimpleRequest\Type\Input;
use Mcustiel\SimpleRequest\Decorator\Form\BasicDecorator;
use Mcustiel\SimpleRequest\Util\HtmlElement;

class Form extends HtmlElement
{
    const ACCEPT_CHARSET = 'accept-charset';
    const ACTION = 'action';
    const AUTOCOMPLETE = 'autocomplete';
    const ENCTYPE = 'enctype';
    const METHOD = 'method';
    const NAME = 'name';
    const NOVALIDATE = 'novalidate';
    const TARGET = 'target';

    /**
     *
     * @var \Mcustiel\SimpleRequest\Annotation\Input[]
     */
    private $elements = [];
    private $decorator;

    public function __construct($formName)
    {
        $this->name = $formName;
        $this->id = $formName;
        $this->decorator = new BasicDecorator();
    }

    public function __toString() {
        return $this->decorator->decorate($this);
    }

    public function getElementsIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    public function addElement(Input $element)
    {
        $element->setFormName($this->name);
        $this->elements[$element->getName()] = $element;
    }

    public function setName($name)
    {
    	$this->name = $name;
    	foreach ($this->elements as $element) {
    		$element->setFormName($name);
    	}
    }

    public function getName()
    {
    	return $this->name;
    }

    public function getDecorator()
    {
        return $this->decorator;
    }

    public function setDecorator($decorator)
    {
        $this->decorator = $decorator;
        return $this;
    }

    public function validate()
    {
        $valid = true;
        foreach ($this->elements as $child) {
            $valid = $valid && $child->validate();
        }
        return $valid;
    }

    public function setRequestValues($request)
    {
    	if (isset($request[$this->name])) {
    		foreach ($request[$this->name] as $inputName => $value) {
    			$this->elements[$inputName]->value = $value;
    		}
    	}
    }
}
