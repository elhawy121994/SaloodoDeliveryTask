<?php

namespace Modules\Infrastructure\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseServiceInterface
{
    public function create(array $requestData): ?Model;
    public function show(int $id): Model;
    public function update(array $requestData, int $id);
    public function list(array $filters = []);
    public function destroy(int $id);
}
