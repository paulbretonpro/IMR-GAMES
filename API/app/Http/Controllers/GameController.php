<?php

namespace App\Http\Controllers;

use App\Filters\GamesFilters;
use App\Http\Requests\GamesStoreRequest;
use App\Http\Resources\GamesResource;
use App\Managers\GamesManager;
use App\Models\Games;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /** @var GamesManager $manager */
    private GamesManager $manager;

    public function __construct(GamesManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return JsonResponse
     */
    public function index() :JsonResponse
    {
        return $this->responseSuccess($this->manager->all());
    }

    /**
     * @param GamesStoreRequest $request
     * @return JsonResponse
     */
    public function store(GamesStoreRequest $request) :JsonResponse
    {
        $newGame = GamesFilters::fromRequest($request);

        if($this->manager->create($newGame)) {
            return $this->responseEmpty();
        }
        return $this->responseError();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id) :JsonResponse
    {
        if($this->manager->delete($id)) {
            return $this->responseEmpty();
        }
        return $this->responseError();
    }
}
