<?php

namespace App\Repositories;

use App\Http\Resources\GamesResource;
use App\Models\Games;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GamesRepository extends CommonRepository
{

    public function __construct(Games $model)
    {
        parent::__construct($model);
    }


}
