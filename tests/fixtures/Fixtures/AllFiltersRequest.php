<?php
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