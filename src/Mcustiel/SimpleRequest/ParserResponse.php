<?php
namespace Mcustiel\SimpleRequest;

class ParserResponse
{
    private $requestObject;
    private $errors;

    public function __construct($requestObject, array $errors)
    {
        $this->errors = $errors;
        $this->requestObject = $requestObject;
    }

    public function getRequestObject()
    {
        return $this->requestObject;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
