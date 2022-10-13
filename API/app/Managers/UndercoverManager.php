<?php

namespace App\Managers;

use App\Repositories\UndercoverRepository;

class UndercoverManager extends CommonManager
{
    public function __construct(UndercoverRepository $repository) {
        $this->repository = $repository;
    }
}
