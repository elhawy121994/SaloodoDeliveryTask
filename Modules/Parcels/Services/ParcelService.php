<?php

namespace Modules\Parcels\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Modules\Infrastructure\Services\BaseService;
use Modules\Parcels\Entities\ParcelPickupDetail;
use Modules\Parcels\Exceptions\AlreadyDeliveredParcelException;
use Modules\Parcels\Exceptions\AlreadyPickedParcelException;
use Modules\Parcels\LookUps\ParcelStatusLookUp;
use Modules\Parcels\Repositories\Interfaces\ParcelRepositoryInterface;
use Modules\Parcels\Services\Interfaces\ParcelServiceInterface;

class ParcelService  extends BaseService implements ParcelServiceInterface
{
    public function __construct(ParcelRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function listSenderParcel(int $senderId, array $filters = []): LengthAwarePaginator
    {
        if (isset($filters['status'])) {
            $this->repository = $this->repository->where('status', $filters['status']);
        }
        return $this->repository->where('sender_id', $senderId)->paginate();
    }

    public function listParcelForPick() :LengthAwarePaginator
    {
        return $this->repository->where('status', ParcelStatusLookUp::READY_FOR_SHIPPING)->with('sender')->paginate();
    }

    /**
     * @throws AlreadyPickedParcelException
     */
    public function pickParcel(int $bickerId, int $parcelId, array $pickUpData): ParcelPickupDetail
    {
        DB::beginTransaction();
        $parcel = $this->repository->getById($parcelId);

        if ($parcel->status !== ParcelStatusLookUp::READY_FOR_SHIPPING) {
            throw new AlreadyPickedParcelException();
        }
        $pickUpDetailsData = ['biker_id' => $bickerId, 'pick_up_at' => $pickUpData['pick_up_at']];
        $createdObject =  $parcel->pickupDetails()->create($pickUpDetailsData);
        $this->repository->updateById($parcel->id, ['status' => ParcelStatusLookUp::SHIPPED]);
        DB::commit();

        return $createdObject;
    }

    /**
     * @throws AlreadyDeliveredParcelException
     */
    public function dropOffParcel(int $bickerId, int $parcelId, array $dropOffData): bool
    {
        DB::beginTransaction();
        $parcel = $this->repository->getById($parcelId);
        if ($parcel->status == ParcelStatusLookUp::DELIVERED) {
            throw new AlreadyDeliveredParcelException();
        }

        $this->repository->updateById($parcel->id, ['status' => ParcelStatusLookUp::SHIPPED]);

        $status = $parcel->pickupDetails->update([
            'status' => ParcelStatusLookUp::DELIVERED,
            'delivered_at' => $dropOffData['delivered_at']
        ]);
        $this->repository->updateById($parcel->id, ['status' => ParcelStatusLookUp::DELIVERED]);
        DB::commit();

        return !empty($status);
    }
}
