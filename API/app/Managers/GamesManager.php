<?php
namespace App\Managers;

use App\Http\Resources\GamesResource;
use App\Managers\CommonManager;
use App\Repositories\GamesRepository;
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
}
