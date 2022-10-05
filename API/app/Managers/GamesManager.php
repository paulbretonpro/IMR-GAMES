<?php
namespace App\Managers;

use App\Filters\GamesFilters;
use App\Http\Resources\GamesResource;
use App\Managers\CommonManager;
use App\Models\Games;
use App\Repositories\GamesRepository;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GamesManager extends CommonManager
{
    public function __construct(GamesRepository $gamesRepository) {
        $this->repository = $gamesRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function all() : AnonymousResourceCollection
    {
        return GamesResource::collection($this->repository->all());
    }

    /**
     * @param GamesFilters $filters
     * @return bool|string
     */
    public function create(GamesFilters $filters) :bool|string
    {
        return $this->repository->create(new Games([
            'name' => $filters->name,
            'rule' => $filters->rule,
        ]));
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) :bool
    {
        $game = Games::find($id);
        if($game) {
            return $this->repository->delete($game);
        } else {
            return false;
        }
    }

    /**
     * @param GamesFilters $updateGame
     * @param int $id
     * @return bool
     */
    public function update(GamesFilters $updateGame, int $id) :bool
    {
        $game = Games::find($id);
        if($game) {
            return $this->repository->update($updateGame, $game);
        }
        return false;
    }
}
