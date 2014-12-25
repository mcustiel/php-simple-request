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

class InputType
{
    const INPUT_TYPE_BUTTON = 'button';
    const INPUT_TYPE_CHECKBOX = 'checkbox';
    const INPUT_TYPE_COLOR = 'color';
    const INPUT_TYPE_DATE = 'date';
    const INPUT_TYPE_DATETIME = 'datetime';
    const INPUT_TYPE_DATETIME_LOCAL = 'datetime-local';
    const INPUT_TYPE_EMAIL = 'email';
    const INPUT_TYPE_FILE = 'file';
    const INPUT_TYPE_HIDDEN = 'hidden';
    const INPUT_TYPE_IMAGE = 'image';
    const INPUT_TYPE_MONTH = 'month';
    const INPUT_TYPE_NUMBER = 'number';
    const INPUT_TYPE_PASSWORD = 'password';
    const INPUT_TYPE_RADIO = 'radio';
    const INPUT_TYPE_RANGE = 'range';
    const INPUT_TYPE_RESET = 'reset';
    const INPUT_TYPE_SEARCH = 'search';
    const INPUT_TYPE_SUBMIT = 'submit';
    const INPUT_TYPE_TELEPHONE = 'tel';
    const INPUT_TYPE_TEXT = 'text';
    const INPUT_TYPE_TIME = 'time';
    const INPUT_TYPE_URL = 'url';
    const INPUT_TYPE_WEEK = 'week';

    const INPUT_TYPE_TEXTAREA = 'textarea';

    private $type;

    public function __construct($type)
    {
        if (!self::isValidInputType($type)) {
            // throw exception;
        }
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public static function isValidInputType($type)
    {
        return in_array($type, (new \ReflectionClass(self::class))->getConstants());
    }
}