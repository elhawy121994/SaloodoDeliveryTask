<?php

namespace Modules\Parcels\Repositories;

use Modules\Infrastructure\Repositories\BaseRepository;
use Modules\Parcels\Entities\Parcel;
use Modules\Parcels\Repositories\Interfaces\ParcelRepositoryInterface;

class ParcelRepository extends BaseRepository implements ParcelRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Parcel;
    }
}
