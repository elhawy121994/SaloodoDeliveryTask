<?php

namespace Modules\Infrastructure\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Infrastructure\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\Infrastructure\Services\Interfaces\BaseServiceInterface;

class BaseService implements BaseServiceInterface
{
    /**
     * @var BaseRepositoryInterface
     */
    public $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $requestData): ?Model
    {
        return $this->repository->create($requestData);
    }

    public function show(int $id): Model
    {
        return $this->repository->getById($id);
    }

    public function update(array $requestData, int $id)
    {
        return $this->repository->updateById($id, $requestData);
    }

    public function list(array $filters = [])
    {
        return $this->repository->paginate();
    }

    public function destroy(int $id)
    {
        return $this->repository->deleteById($id);
    }


}
