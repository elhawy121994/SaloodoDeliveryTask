<?php

namespace Modules\Senders\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Infrastructure\Http\Controllers\BaseController;
use Modules\Senders\Services\Interfaces\SenderServiceInterface;
use Modules\Senders\Transformers\SenderParserTransformer;

class SendersController extends BaseController
{
    public function __construct(SenderServiceInterface $service)
    {
        $this->service = $service;
    }

    public function listParcel(): JsonResponse
    {
        try {
            $parsers = $this->service->listParcel(auth()->user()->morph_user_id);

            return $this->accepted(SenderParserTransformer::collection($parsers));
        } catch (Exception $exception) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('infrastructure::translate.InternalServerError'));
        }
    }

    public function showSenderParcel(int $parcelId): JsonResponse
    {
        try {
            $parser = $this->service->showSenderParcel(auth()->user()->morph_user_id, $parcelId);

            return $this->accepted(SenderParserTransformer::make($parser));
        } catch (Exception $exception) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('infrastructure::translate.InternalServerError'));
        }
    }
}
