<?php

namespace App\Http\Controllers;

use App\Filters\UndercoverMembersFilters;
use App\Http\Requests\UndercoverMembersStoreRequest;
use App\Managers\UndercoverManager;
use App\Models\Undercover;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UndercoverMembersController extends Controller
{
    /** @var UndercoverManager $manager */
    private UndercoverManager $manager;

    public function __construct(UndercoverManager $manager) {
        $this->manager = $manager;
    }

    /**
     * @param Undercover $undercover
     * @param UndercoverMembersStoreRequest $request
     * @return JsonResponse
     */
    public function store(Undercover $undercover, UndercoverMembersStoreRequest $request): JsonResponse
    {
        $newPlayer = UndercoverMembersFilters::fromRequest($request);

        try {
            $member = $this->manager->newMember($newPlayer, $undercover->id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->responseError();
        }


        if($member && $this->manager->newUndercoverMember($newPlayer, $member->id, $undercover->id)) {
            return $this->responseEmpty();
        }

        //suppression si ECHEC creation undercoverMembers
        if($member != false) {
            $member->delete();
        }

        return $this->responseError();
    }

    /**
     * @param int $undercoverId
     * @param int $undercoverMemberId
     * @return JsonResponse
     */
    public function destroy($undercoverId, int $undercoverMemberId): JsonResponse
    {
        if ($this->manager->deleteMember($undercoverMemberId)) {
            return $this->responseEmpty();
        }
        return $this->responseError();
    }
}
