<?php

namespace Modules\Parcels\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Infrastructure\Exceptions\AbstractCustomException;
use Modules\Infrastructure\Http\Controllers\BaseController;
use Modules\Parcels\Http\Requests\CreateParcelsRequest;
use Modules\Parcels\Services\Interfaces\ParcelServiceInterface;
use Illuminate\Http\Response;

class ParcelsController extends BaseController
{
    public function __construct(ParcelServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @throws AbstractCustomException
     */
    public function create(CreateParcelsRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        try {
            $requestData['sender_id'] = auth()->user()->morph_user_id;
            $createdObject = $this->service->create($requestData);
            if ($createdObject) {
                return $this->ok([
                    'data' => $createdObject,
                    'message' => __('infrastructure::translate.SavedSuccessfully')
                ]);
            }
            return $this->errorResponse(__('infrastructure::translate.OperationNotDone'), 409,
                Response::HTTP_BAD_REQUEST);
        } catch (AbstractCustomException $e) {
            throw $e;
        } catch (Exception $e) {
            return $this->errorResponse(Response::HTTP_INTERNAL_SERVER_ERROR,
                __('infrastructure::translate.InternalServerErrorTryLater'));
        }
    }
    public function show(int $id)
    {
        try {
            $parcel = $this->service->show($id);
            if ($parcel) {
                return $this->ok(['data' => $parcel]);
            }
            return $this->errorResponse(409, trans('infrastructure::translate.InternalServerErrorTryLater'));
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse(404, trans('infrastructure::translate.ModelNotExist'), Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $this->errorResponse(500, trans('infrastructure::translate.InternalServerErrorTryLater'));
        }
    }
}
