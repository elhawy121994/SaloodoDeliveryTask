<?php

namespace Modules\Senders\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Infrastructure\Services\BaseService;
use Modules\Parcels\Entities\Parcel;
use Modules\Parcels\Repositories\Interfaces\ParcelRepositoryInterface;
use Modules\Senders\Repositories\Interfaces\SenderRepositoryInterface;
use Modules\Senders\Services\Interfaces\SenderServiceInterface;

class SenderService extends BaseService implements SenderServiceInterface
{
    /**
     * @var ParcelRepositoryInterface
     */
    protected $parcelRepository;
    public function __construct(SenderRepositoryInterface $repository, ParcelRepositoryInterface $parcelRepository)
    {
        parent::__construct($repository);
        $this->parcelRepository = $parcelRepository;
    }

    public function listParcel(int $senderId): LengthAwarePaginator
    {
        $sender = $this->repository->getById($senderId);

        return $this->parcelRepository->where('sender_id', $sender->id)->paginate();
    }

    public function showSenderParcel(int $senderId, int $parcelId): Parcel
    {
        $sender = $this->repository->getById($senderId);

        return $this->parcelRepository->where('id', $parcelId)->where('sender_id', $sender->id)->first();
    }
}
