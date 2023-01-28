<?php

namespace Modules\Parcels\Exceptions;

use Modules\Infrastructure\Exceptions\AbstractCustomException;
use Modules\Infrastructure\Exceptions\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;

class AlreadyPickedParcelException extends AbstractCustomException
{
    public function setErrorCode()
    {
        $this->errorCode = ErrorCodes::PARCEL_ALREADY_PICKED;
    }

    public function setStatusCode()
    {
        $this->statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    public function setMessage()
    {
        $this->message = __('infrastructure::translate.NotAvailableAnyMore');
    }
}
