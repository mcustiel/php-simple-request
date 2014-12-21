<?php
namespace Fixtures;

use Mcustiel\SimpleRequest\Annotation\Name;
use Mcustiel\SimpleRequest\Annotation\Validator\NotNull;
use Mcustiel\SimpleRequest\Annotation\Validator\NotEmpty;
use Mcustiel\SimpleRequest\Annotation\Filter\Trim;
use Mcustiel\SimpleRequest\Annotation\Filter\UpperCase;

/**
 * @Name("NameUsedToCacheThis")
 * @author mcustiel
 */
class PersonRequest
{
    /**
     * @NotNull
     * @NotEmpty
     * @Trim
     * @var unknown
     */
    private $firstName;
    /**
     * @Trim
     * @UpperCase
     * @NotNull
     * @NotEmpty
     * @var unknown
     */
    private $lastName;
    /**
     * @var unknown
     */
    private $age;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }
}