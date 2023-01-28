<?php

namespace Modules\Senders\Services\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Infrastructure\Services\Interfaces\BaseServiceInterface;
use Modules\Parcels\Entities\Parcel;

interface SenderServiceInterface extends BaseServiceInterface
{
    public function listParcel(int $senderId): LengthAwarePaginator;

    public function showSenderParcel(int $senderId, int $parcelId): Parcel;
}
