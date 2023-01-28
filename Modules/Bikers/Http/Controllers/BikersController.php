<?php

namespace Modules\Bikers\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Bikers\Http\Requests\DropOffParcelRequest;
use Modules\Bikers\Http\Requests\PickParcelRequest;
use Modules\Bikers\Services\Interfaces\BikerServiceInterface;
use Modules\Bikers\Transformers\BikerParserTransformer;
use Modules\Infrastructure\Exceptions\AbstractCustomException;
use Modules\Infrastructure\Http\Controllers\BaseController;

class BikersController extends BaseController
{
    public function __construct(BikerServiceInterface $service)
    {
        $this->service = $service;
    }

    public function listParcelForPick()
    {
        try {
            $parsers = $this->service->listParcel();

            return BikerParserTransformer::collection($parsers);
        } catch (Exception $exception) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR,
                __('infrastructure::translate.InternalServerError'));
        }
    }

    public function pickParcel(PickParcelRequest $request, $parcelId): JsonResponse
    {
        try {
            $dropOffDetails = $request->validated();
            $pickUpDetails = $this->service->pickParcel(auth()->user()->morph_user_id, $parcelId, $dropOffDetails);
            if ($pickUpDetails) {
                return $this->accepted([
                    'data' => $pickUpDetails,
                    'message' => __('infrastructure::translate.UpdatedSuccessfully')
                ]);
            }
            return $this->errorResponse(__('infrastructure::translate.OperationNotDone'), 409,
                Response::HTTP_BAD_REQUEST);
        } catch (AbstractCustomException $e) {
            throw $e;
        } catch (Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR,
                __('infrastructure::translate.InternalServerErrorTryLater')
            );
        }
    }
    public function dropOffParcel(DropOffParcelRequest $request, int $parcelId): JsonResponse
    {
        $dropOffDetails = $request->validated();
        try {
            $dropOffDetails = $this->service->dropOffParcel(auth()->user()->morph_user_id, $parcelId, $dropOffDetails);
            if ($dropOffDetails) {
                return $this->accepted([
                    'data' => $dropOffDetails,
                    'message' => __('infrastructure::translate.UpdatedSuccessfully')
                ]);
            }
            return $this->errorResponse(__('infrastructure::translate.OperationNotDone'), 409,
                Response::HTTP_BAD_REQUEST);
        } catch (AbstractCustomException $e) {
            throw $e;
        } catch (Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR,
                __('infrastructure::translate.InternalServerErrorTryLater')
            );
        }
    }
}