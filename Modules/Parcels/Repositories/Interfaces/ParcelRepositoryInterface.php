<?php

namespace Modules\Parcels\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Infrastructure\Repositories\Interfaces\BaseRepositoryInterface;

interface ParcelRepositoryInterface extends BaseRepositoryInterface
{
    public function listParcelForDropOff(int $bikerId): LengthAwarePaginator;
}
