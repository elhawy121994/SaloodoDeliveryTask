<?php

namespace Modules\Parcels\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Infrastructure\Repositories\BaseRepository;
use Modules\Parcels\Entities\Parcel;
use Modules\Parcels\LookUps\ParcelStatusLookUp;
use Modules\Parcels\Repositories\Interfaces\ParcelRepositoryInterface;

class ParcelRepository extends BaseRepository implements ParcelRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Parcel;
    }

    public function listParcelForDropOff(int $bikerId): LengthAwarePaginator
    {
        return $this->model->where('status', ParcelStatusLookUp::SHIPPED)
            ->join('parcels_pickup_details', 'parcels_pickup_details.parcel_id', 'parcels.id')
            ->where('parcels_pickup_details.biker_id', $bikerId)->paginate($this->model->getPerPage() ?? 50);
    }
}
