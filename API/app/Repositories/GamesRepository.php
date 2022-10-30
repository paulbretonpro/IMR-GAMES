<?php

namespace App\Repositories;

use App\Filters\GamesFilters;
use App\Models\Games;
use Illuminate\Database\Eloquent\Builder;

class GamesRepository extends CommonRepository
{

    public function __construct(Games $model)
    {
        parent::__construct($model);
    }

    /**
     * @param GamesFilters $updateGame
     * @param Games $games
     * @return bool
     */
    public function update(GamesFilters $updateGame, Games $games) :bool
    {
        if(isset($updateGame->rule)) {
            $games->rule = $updateGame->rule;
        }
        if(isset($updateGame->name)) {
            $games->name = $updateGame->name;
        }

        return $games->save();
    }

    /**
     * @param string $code
     * @return Builder
     */
    public function getGame(string $code): Builder
    {
        return Games::query()->where('code', '=', $code);
    }


}
