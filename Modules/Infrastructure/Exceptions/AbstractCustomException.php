<?php

namespace Modules\Infrastructure\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class AbstractCustomException extends Exception
{
    protected $statusCode;
    protected $errorCode;
    protected $message;

    abstract protected function setErrorCode();
    abstract protected function setStatusCode();
    abstract protected function setMessage();

    public function __construct()
    {
        $this->setStatusCode();
        $this->setErrorCode();
        $this->setMessage();

        parent::__construct();
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        $data = array(
            'code' => $this->errorCode,
            'message' => $this->message,
        );

        return response()->json($data, $this->statusCode);
    }
}
