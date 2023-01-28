<?php

namespace Modules\Parcels\Services\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Infrastructure\Services\Interfaces\BaseServiceInterface;
use Modules\Parcels\Entities\ParcelPickupDetail;

interface ParcelServiceInterface extends BaseServiceInterface
{
    public function listParcelForPick():LengthAwarePaginator;

    public function pickParcel(int $bickerId, int $parcelId, array $pickUpData): ParcelPickupDetail;

    public function dropOffParcel(int $bickerId, int $parcelId, array $dropOffData): bool;
}
