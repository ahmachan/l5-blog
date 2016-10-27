<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\MenuInterface;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;

abstract class MenuImpRepository implements MenuInterface
{
    protected $app;
    protected $model;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    public function all($columns = ['*'])
    {
        // TODO: Implement all() method.
        return $this->model->all($columns);
    }

    public function find($id, $columns = ['*'])
    {
        // TODO: Implement find() method.
        return $this->model->select($columns)->find($id);
    }

    public function findByField($field, $value, $columns = ['*'])
    {
        // TODO: Implement findByField() method.
        return $this->model->select($columns)->where($field,$value)->get();
    }

    public function findWhere(array $where, $columns = ['*'])
    {
        // TODO: Implement findWhere() method.
    }

    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        // TODO: Implement findWhereIn() method.
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        $model = new $this->model;
        return $model->fill($attributes)->save();
    }
    public function update(array $attributes, $id)
    {
        // TODO: Implement update() method.
        return $this->model->where('id', $id)->update($attributes);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        // TODO: Implement updateOrCreate() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function orderBy($column, $direction = 'asc')
    {
        // TODO: Implement orderBy() method.
        return $this->model->orderBy($column, $direction)->get()->toArray();
    }

    public function with($relations)
    {
        // TODO: Implement with() method.
    }

    public function insertGetId($data)
    {
        // TODO: Implement insertGetId() method.
        return $this->model->insertGetId($data);
    }
}