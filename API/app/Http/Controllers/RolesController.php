<?php

namespace App\Http\Controllers;

use App\Filters\RolesFilters;
use App\Http\Requests\RolesStoreRequest;
use App\Managers\RolesManagers;
use Illuminate\Http\JsonResponse;

class RolesController extends Controller
{
    /** @var RolesManagers $managers */
    private RolesManagers $manager;

    public function __construct(RolesManagers $rolesManager) {
        $this->manager = $rolesManager;
    }

    /**
     * @param int $id
     * @param RolesStoreRequest $request
     * @return JsonResponse
     */
    public function store(int $id, RolesStoreRequest $request): JsonResponse
    {
        $newRole = RolesFilters::fromRequest($request);

        if ($this->manager->create($newRole, $id)) {
            return $this->responseEmpty();
        }

        return $this->responseError();
    }

    /**
     * @param int $idGame
     * @param int $idRole
     * @return JsonResponse
     */
    public function destroy(int $idGame, int $idRole) :JsonResponse
    {
        if($this->manager->delete($idRole)) {
            return $this->responseEmpty();
        }

        return $this->responseError();
    }
}
