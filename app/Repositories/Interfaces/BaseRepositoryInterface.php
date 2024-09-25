<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Repositories\Interfaces
 */
interface BaseRepositoryInterface
{
  public function all();
  public function create(array $payload);
  public function findById(int $id);
  public function update(int $id = 0, array $payload = []);
  public function delete(int $id = 0);
  public function pagination(
    array $column = ['*'], 
    array $condition = [], 
    int $perPage = 1,
    array $extend = [],
    array $orderBy = ['id', 'DESC'],
    array $join = [],
    array $relations = [],
    array $rawQuery = [],
  );
  public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
  public function createPivot($model, array $payload = [], string $relation = '');
}