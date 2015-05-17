<?php
namespace Mcustiel\SimpleRequest;

/**
 * Represents a response from a RequestParser object.
 *
 * @deprecated Will be removed in version 2.0 in favor
 *             of a behaviour change in AllErrorsRequestParser.
 * @author mcustiel
 */
class ParserResponse
{
    /**
     * The request object being parsed.
     *
     * @var object
     */
    private $requestObject;
    /**
     * Collection of errors from the parse process.
     *
     * @var array
     */
    private $errors;

    /**
     * Class constructor
     *
     * @param object $requestObject Object being parsed.
     * @param array  $errors        List of errors occurred during validation.
     */
    public function __construct($requestObject, array $errors)
    {
        $this->errors = $errors;
        $this->requestObject = $requestObject;
    }

    /**
     * Returns the request object.
     *
     * @return object
     */
    public function getRequestObject()
    {
        return $this->requestObject;
    }

    /**
     * Returns the list of errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Says if the object is valid or not.
     *
     * @return boolean
     */
    public function isValid()
    {
        return empty($this->errors);
    }
}
