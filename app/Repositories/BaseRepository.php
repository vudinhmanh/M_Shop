<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
  protected $model;
  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function all()
  {
    return $this->model->all();
  }
  public function create(array $payload = [])
  {
    $model = $this->model->create($payload);
    return $model->fresh();
  }
  public function update(int $id = 0, array $payload = [])
  {
    $model = $this->findById($id);
    return $model->update($payload);
  }
  //update publish all users
  public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [])
  {
    return $this->model->whereIn($whereInField, $whereIn)->update($payload);
  }
  public function updateByWhere($condition = [], array $payload = []){
    $query = $this->model->newQuery();
    foreach($condition as $key => $val){
      $query->where($val[0], $val[1], $val[2]);
    }
    return $query->update($payload);
  }
  public function delete(int $id = 0)
  {
    return $this->findById($id)->delete();
  }
  //Xoá vĩnh viễn khỏi dữ liệu
  public function forceDelete(int $id = 0)
  {
    return $this->findById($id)->forceDelete();
  }
  public function findById($modelId, array $column = ['*'], array $relation = [])
  {
    return $this->model->select($column)->with($relation)->findOrFail($modelId);
  }
  public function createPivot($model, array $payload = [], string $relation = '')
  {
    return $model->{$relation}()->attach($model->id, $payload);
  }

  public function pagination(
    array $column = ['*'],
    array $condition = [],
    int $perPage = 1,
    array $extend = [],
    array $orderBy = ['id', 'DESC'],
    array $join = [],
    array $relations = [],
    array $rawQuery = []

  ) {
    $query = $this->model->select($column);
    return $query
      ->keyword($condition['keyword'] ?? null)
      ->publish($condition['publish'] ?? null)
      ->relationCount($relations ?? null)
      ->CustomWhere($condition['where'] ?? null)
      ->customWhereRaw($rawQuery['whereRaw'] ?? null)
      ->customJoin($join ?? null)
      ->customGroupBy($extend['groupBy'] ?? null)
      ->customOrderBy($orderBy ?? null)
      ->paginate($perPage)
      ->withQueryString()->withPath(env('APP_URL') . $extend['path']);
  }
}
