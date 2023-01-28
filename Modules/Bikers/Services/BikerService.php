<?php

namespace Modules\Bikers\Services;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Bikers\Services\Interfaces\BikerServiceInterface;
use Modules\Infrastructure\Services\BaseService;
use Modules\Parcels\Entities\ParcelPickupDetail;
use Modules\Parcels\Repositories\Interfaces\ParcelRepositoryInterface;
use Modules\Parcels\Services\Interfaces\ParcelServiceInterface;
use Modules\Senders\Repositories\Interfaces\SenderRepositoryInterface;

class BikerService  extends BaseService implements BikerServiceInterface
{
    /**
     * @var ParcelServiceInterface
     */
    protected $parcelService;
    public function __construct(SenderRepositoryInterface $repository, ParcelServiceInterface $parcelService)
    {
        parent::__construct($repository);
        $this->parcelService = $parcelService;
    }

    public function listParcel(): LengthAwarePaginator
    {
        return $this->parcelService->listParcelForPick();
    }

    /**
     * @param int $bickerId
     * @param int $parcelId
     * @return ParcelPickupDetail*
     */
    public function pickParcel(int $bickerId, int $parcelId, array $pickUpDates): ParcelPickupDetail
    {
        return $this->parcelService->pickParcel($bickerId, $parcelId, $pickUpDates);
    }

    public function dropOffParcel(int $bickerId, int $parcelId, array $dropOffData): bool
    {
        return $this->parcelService->dropOffParcel($bickerId, $parcelId, $dropOffData);
    }
}
