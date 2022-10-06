<?php

namespace App\Repositories;

use App\Models\Roles;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class RolesRepository extends CommonRepository
{
    /**
     * @param Roles $model
     */
    #[Pure]
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }

}
