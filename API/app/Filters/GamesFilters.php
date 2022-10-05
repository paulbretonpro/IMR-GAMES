<?php

namespace App\Filters;
use App\Models\Games;

class GamesFilters extends DataTransferObject
{
    /** @var string */
    public $name;
    /** @var string */
    public $rule;
}
