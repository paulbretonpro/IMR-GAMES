<?php

namespace App\Managers;

use App\Filters\RolesFilters;
use App\Models\Roles;
use App\Repositories\RolesRepository;

class RolesManagers extends CommonManager
{
    /**
     * @param RolesRepository $repository
     */
    public function __construct(RolesRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param RolesFilters $newRole
     * @param int $id
     * @return bool|void
     */
    public function create(RolesFilters $newRole, int $id)
    {
        return $this->repository->create(new Roles([
            'name' => $newRole->name,
            'description' => $newRole->description,
            'games_id' => $id,
        ]));
    }
}
