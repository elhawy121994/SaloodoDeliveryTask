<?php

namespace Modules\Infrastructure\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function all();

    public function paginate(): LengthAwarePaginator;

    public function create(array $data);

    public function deleteById($id);

    public function get();

    public function getById($id);

    public function limit($limit);

    public function orderBy($column, $direction = 'asc');

    public function updateById($id, array $data);

    public function where($column, $value, $operator = '=');

    public function orWhere($column, $value, $operator = '=');

    public function whereIn($column, $values);

    public function with($relations);

    public function first();

}
