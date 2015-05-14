<?php
namespace Fixtures;

use Mcustiel\SimpleRequest\Annotation\Validator as Annot;

/**
 * @author mcustiel
 */
class AllValidatorsRequest
{
    /**
     * @Annot\CustomValidator(class="Mcustiel\SimpleRequest\Validator\Integer")
     *
     * @var unknown
     */
    private $custom;
    /**
     * @Annot\Date("d/m/Y H:i:s")
     *
     * @var unknown
     */
    private $date;
    /**
     * @Annot\Email
     *
     * @var unknown
     */
    private $email;
    /**
     * @Annot\Float(true)
     *
     * @var unknown
     */
    private $float;
    /**
     * @Annot\Integer
     *
     * @var unknown
     */
    private $integer;
    /**
     * @Annot\IPV4
     *
     * @var unknown
     */
    private $ipv4;
    /**
     * @Annot\IPV6
     *
     * @var unknown
     */
    private $ipv6;
    /**
     * @Annot\Items(items={ @Annot\Type("integer"), @Annot\MaxLength(5) }, additionalItems=false)
     * @var unknown
     */
    private $items;
    /**
     * @Annot\MaxLength(5)
     *
     * @var unknown
     */
    private $maxLength;
    /**
     * @Annot\MinLength(2)
     *
     * @var unknown
     */
    private $minLength;
    /**
     * @Annot\NotEmpty
     *
     * @var unknown
     */
    private $notEmpty;
    /**
     * @Annot\NotNull
     *
     * @var unknown
     */
    private $notNull;
    /**
     * @Annot\Properties(properties={
     *     "key1", @Annot\Type("integer"),
     *     "key2", @Annot\MaxLength(5)
     * }, additionalProperties=false)
     *
     * @var unknown
     */
    private $properties;
    /**
     * @Annot\RegExp("/[a-z]{3}[0-9]{3}/")
     *
     * @var unknown
     */
    private $regExp;
    /**
     * @Annot\Required( {"key1", "key2"} )
     *
     * @var unknown
     */
    private $required;
    /**
     * @Annot\TwitterAccount
     *
     * @var unknown
     */
    private $twitterAccount;
    /**
     * @Annot\Uri
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

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
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

    public function getProperties()
    {
        return $this->properties;
    }

    public function setProperties($properties)
    {
        $this->properties = $properties;
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

    public function getRequired()
    {
        return $this->required;
    }

    public function setRequired($required)
    {
        $this->required = $required;
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