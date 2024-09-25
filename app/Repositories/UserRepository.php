<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  protected $model;
  public function __construct(User $model){
    $this->model = $model;
  }
  public function getAllPaginate(){
    return User::paginate(10);
  }
  public function userPagination
  (
    array $column = ['*'], 
    array $condition = [], 
    int $perPage = 1,
    array $extend = [],
    array $orderBy = ['id', 'DESC'],
    array $join = [],
    array $relations = [],
    )
    {
    $query = $this->model->select($column)->where(function($query) use ($condition){
      if(isset($condition['keyword']) && !empty($condition['keyword'])){
        $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
              ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
              ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%')
              ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%');
      }
      if (isset($condition['catalogue']) && !empty($condition['catalogue'])) {
        $query->where('user_catalogue_id', '=', $condition['catalogue']);
      }
    })->with('user_catalogues');
    if(!empty($join)){
      $query->join(...$join);
    }
    return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
  }
}
