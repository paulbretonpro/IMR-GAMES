<?php

namespace App\Filters;
use App\Models\Roles;

class RolesFilters extends DataTransferObject
{
    /** @var string */
    public $name;
    /** @var string */
    public $description;
}
