<?php
namespace Mcustiel\SimpleRequest\Strategies\Properties;

interface PropertyParser
{
    /**
     *
     * @param mixed $propertyValue Extra data to pass to the parser
     * @return \Mcustiel\SimpleRequest\PropertyParser
     */
    public function parse($propertyValue);

    /**
     * @param array $validators
     * @return \Mcustiel\SimpleRequest\PropertyParser
     */
    public function setValidators(array $validators);

    /**
     * @param array $filters
     * @return \Mcustiel\SimpleRequest\PropertyParser
     */
    public function setFilters(array $filters);

    /**
     * @return string
     */
    public function getName();
}
