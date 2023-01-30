<?php

namespace Modules\Bikers\Services\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Infrastructure\Services\Interfaces\BaseServiceInterface;
use Modules\Parcels\Entities\ParcelPickupDetail;

interface BikerServiceInterface extends BaseServiceInterface
{
    public function listParcelForPick(): LengthAwarePaginator;

    public function listParcelForDropOff(int $bikerId): LengthAwarePaginator;
    public function pickParcel(int $bickerId, int $parcelId, array $pickUpDates): ParcelPickupDetail;
    public function dropOffParcel(int $bickerId, int $parcelId, array $dropOffData): bool;
}
