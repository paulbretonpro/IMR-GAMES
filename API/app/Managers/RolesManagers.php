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

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) :bool
    {
        $role = Roles::find($id);
        if($role) {
            return $this->repository->delete($role);
        } else {
            return false;
        }
    }
}
