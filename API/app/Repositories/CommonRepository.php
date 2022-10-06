<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
     * @return bool|void
     */
    public function create(Model $data)
    {
        try {
            if (get_class($data) == get_class($this->model)) {
                return $data->save();
            }
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
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
