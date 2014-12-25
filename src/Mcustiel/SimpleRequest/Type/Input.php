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

use Mcustiel\SimpleRequest\Decorator\Input\BasicDecorator;
use Mcustiel\SimpleRequest\Decorator\Input\Decorator;
use Mcustiel\SimpleRequest\Util\HtmlElement;
use Mcustiel\SimpleRequest\Validator\ValidatorInterface;

class Input extends HtmlElement
{
    private $label;
    /**
     *
     * @var \Mcustiel\SimpleRequest\Validator\ValidatorInterface[]
     */
    protected $validators = [];
    /**
     *
     * @var Decorator
     */
    protected $decorator;
    protected $formName = '';

    public function __construct($name, InputType $type = null)
    {
        $this->decorator = new BasicDecorator();
        if (!empty($type)) {
            $this->type = $type->getType();
        }
        if (empty($name)) {
            $name = "input" . ucfirst($this->type) . "_" . time();
        }
        $this->name = $name;
        $this->id = $name;
        $this->label = $name;
    }
    
    public function getFormName() 
    {
    	return $this->formName;	
    }
    
    public function setFormName($formName)
    {
    	$this->formName = $formName;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
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

    /**
     *
     * @return multitype:\Mcustiel\SimpleRequest\Validator\ValidatorInterface
     */
    public function getValidators()
    {
        return $this->validators;
    }

    public function setValidators($validators)
    {
        $this->validators = $validators;
        return $this;
    }

    public function validate()
    {
        $valid = true;
        foreach ($this->validators as $validator) {
            $valid = $valid && $validator->validate($this->value);
        }
        return $valid;
    }

    public function addValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
    }

    public function __toString()
    {
        return $this->decorator->decorate($this);
    }

    public function __set($name, $value)
    {
        if (property_exists(self::class, $name)) {
            $this->$name = $value;
        } else {
            parent::__set($name, $value);
        }
    }
 }