<?php
namespace Fixtures;

use Mcustiel\SimpleRequest\Annotation\Validator\CustomValidator;
use Mcustiel\SimpleRequest\Annotation\Validator\Date;
use Mcustiel\SimpleRequest\Annotation\Validator\Email;
use Mcustiel\SimpleRequest\Annotation\Validator\Float;
use Mcustiel\SimpleRequest\Annotation\Validator\Integer;
use Mcustiel\SimpleRequest\Annotation\Validator\IPV4;
use Mcustiel\SimpleRequest\Annotation\Validator\IPV6;
use Mcustiel\SimpleRequest\Annotation\Validator\MaxLength;
use Mcustiel\SimpleRequest\Annotation\Validator\MinLength;
use Mcustiel\SimpleRequest\Annotation\Validator\NotEmpty;
use Mcustiel\SimpleRequest\Annotation\Validator\NotNull;
use Mcustiel\SimpleRequest\Annotation\Validator\RegExp;
use Mcustiel\SimpleRequest\Annotation\Validator\TwitterAccount;
use Mcustiel\SimpleRequest\Annotation\Validator\Url;

/**
 * @author mcustiel
 */
class AllValidatorsRequest
{
    /**
     * @CustomValidator(class="Mcustiel\SimpleRequest\Validator\Integer")
     *
     * @var unknown
     */
    private $custom;
    /**
     * @Date("d/m/Y H:i:s")
     *
     * @var unknown
     */
    private $date;
    /**
     * @Email
     *
     * @var unknown
     */
    private $email;
    /**
     * @Float(true)
     *
     * @var unknown
     */
    private $float;
    /**
     * @Integer
     *
     * @var unknown
     */
    private $integer;
    /**
     * @IPV4
     *
     * @var unknown
     */
    private $ipv4;
    /**
     * @IPV6
     *
     * @var unknown
     */
    private $ipv6;
    /**
     * @MaxLength(5)
     *
     * @var unknown
     */
    private $maxLength;
    /**
     * @MinLength(2)
     *
     * @var unknown
     */
    private $minLength;
    /**
     * @NotEmpty
     *
     * @var unknown
     */
    private $notEmpty;
    /**
     * @NotNull
     *
     * @var unknown
     */
    private $notNull;
    /**
     * @RegExp("/[a-z]{3}[0-9]{3}/")
     *
     * @var unknown
     */
    private $regExp;
    /**
     * @TwitterAccount
     *
     * @var unknown
     */
    private $twitterAccount;
    /**
     * @Url
     *
     * @var unknown
     */
    private $url;

    public function getCustom()
    {
        return $this->custom;
    }

    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getFloat()
    {
        return $this->float;
    }

    public function setFloat($float)
    {
        $this->float = $float;
        return $this;
    }

    public function getInteger()
    {
        return $this->integer;
    }

    public function setInteger($integer)
    {
        $this->integer = $integer;
        return $this;
    }

    public function getIpv4()
    {
        return $this->ipv4;
    }

    public function setIpv4($ipv4)
    {
        $this->ipv4 = $ipv4;
        return $this;
    }

    public function getIpv6()
    {
        return $this->ipv6;
    }

    public function setIpv6($ipv6)
    {
        $this->ipv6 = $ipv6;
        return $this;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    public function getMinLength()
    {
        return $this->minLength;
    }

    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
        return $this;
    }

    public function getNotEmpty()
    {
        return $this->notEmpty;
    }

    public function setNotEmpty($notEmpty)
    {
        $this->notEmpty = $notEmpty;
        return $this;
    }

    public function getNotNull()
    {
        return $this->notNull;
    }

    public function setNotNull($notNull)
    {
        $this->notNull = $notNull;
        return $this;
    }

    public function getRegExp()
    {
        return $this->regExp;
    }

    public function setRegExp($regExp)
    {
        $this->regExp = $regExp;
        return $this;
    }

    public function getTwitterAccount()
    {
        return $this->twitterAccount;
    }

    public function setTwitterAccount($twitterAccount)
    {
        $this->twitterAccount = $twitterAccount;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}