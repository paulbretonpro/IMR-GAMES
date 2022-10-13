<?php

namespace App\Repositories;

use App\Models\Undercover;

class UndercoverRepository extends CommonRepository
{

    public function __construct(Undercover $model)
    {
        parent::__construct($model);
    }


}
