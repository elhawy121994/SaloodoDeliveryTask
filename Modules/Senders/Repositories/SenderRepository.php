<?php

namespace Modules\Senders\Repositories;

use Modules\Infrastructure\Repositories\BaseRepository;
use Modules\Senders\Entities\Sender;
use Modules\Senders\Repositories\Interfaces\SenderRepositoryInterface;

class SenderRepository extends BaseRepository implements SenderRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Sender;
    }
}
