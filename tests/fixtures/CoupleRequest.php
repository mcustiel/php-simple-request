<?php
namespace Fixtures;

use Mcustiel\SimpleRequest\Annotation as SRA;

class CoupleRequest
{
    /**
     * @SRA\Validator\DateTimeFormat("Y-m-d")
     *
     * @var unknown
     */
    private $togetherSince;
    /**
     * @SRA\ParseAs("\Fixtures\PersonRequest")
     *
     * @var \Fixtures\PersonRequest
     */
    private $person1;
    /**
     * @SRA\ParseAs("\Fixtures\PersonRequest")
     *
     * @var \Fixtures\PersonRequest
     */
    private $person2;

    public function getTogetherSince()
    {
        return $this->togetherSince;
    }

    public function setTogetherSince($togetherSince)
    {
        $this->togetherSince = $togetherSince;
        return $this;
    }

    public function getPerson1()
    {
        return $this->person1;
    }

    public function setPerson1($person1)
    {
        $this->person1 = $person1;
        return $this;
    }

    public function getPerson2()
    {
        return $this->person2;
    }

    public function setPerson2($person2)
    {
        $this->person2 = $person2;
        return $this;
    }
}
