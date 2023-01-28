<?php

namespace Modules\Bikers\Repositories;

use Modules\Bikers\Repositories\Interfaces\BikerRepositoryInterface;
use Modules\Infrastructure\Repositories\BaseRepository;
use Modules\Senders\Entities\Sender;

class BikerRepository extends BaseRepository implements BikerRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Biker;
    }
}
