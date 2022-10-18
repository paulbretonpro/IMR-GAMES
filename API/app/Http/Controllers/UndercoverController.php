<?php

namespace App\Http\Controllers;

use App\Http\Resources\UndercoverResource;
use App\Managers\UndercoverManager;
use App\Models\Undercover;
use Illuminate\Http\JsonResponse;

class UndercoverController extends Controller
{
    /** @var UndercoverManager $manager */
    private UndercoverManager $manager;

    public function __construct(UndercoverManager $manager) {
        $this->manager = $manager;
    }

    public function show(int $id) {
        $undercover = Undercover::find($id);
        return $this->responseSuccess(UndercoverResource::make($undercover));
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $uniqId = $this->manager->create();
        if($uniqId) {
            return $this->responseSuccess($uniqId);
        }

        return $this->responseError();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if($this->manager->delete($id)) {
            return $this->responseEmpty();
        }
        return $this->responseError();
    }
}
