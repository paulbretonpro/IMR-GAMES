<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class CommonRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all() {
        return $this->model->all();
    }

    /**
     * @param Model $data
     * @return bool|string
     */
    public function create(Model $data) {
        if (get_class($data) == get_class($this->model)) {
            return $data->save();
        }

        return Exception::class;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model) :bool
    {
        return $model->delete();
    }

}
