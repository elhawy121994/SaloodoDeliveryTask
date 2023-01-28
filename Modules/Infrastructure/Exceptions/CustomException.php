<?php

namespace Modules\Infrastructure\Exceptions;

use Modules\Infrastructure\Exceptions\AbstractCustomException;
use Modules\Infrastructure\Exceptions\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;

class CustomException extends AbstractCustomException
{
    public function setErrorCode()
    {
        $this->errorCode = ErrorCodes::MY_ERROR_CODE_EXAMPLE;
    }

    public function setStatusCode()
    {
        $this->statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    public function setMessage()
    {
        $this->message = "Custom Exception Message";
    }
}
