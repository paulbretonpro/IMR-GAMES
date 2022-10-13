<?php

namespace App\Http\Controllers;


use App\Http\Requests\UndercoverStoreRequest;
use App\Managers\UndercoverManager;
use Illuminate\Http\JsonResponse;

class UndercoverController extends Controller
{
    /** @var UndercoverManager $manager */
    private UndercoverManager $manager;

    public function __construct(UndercoverManager $manager) {
        $this->manager = $manager;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
    }

    /**
     * @param UndercoverStoreRequest $request
     * @return void
     */
    public function store(UndercoverStoreRequest $request)
    {
    }
}
