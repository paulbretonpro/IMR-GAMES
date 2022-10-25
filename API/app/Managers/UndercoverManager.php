<?php

namespace App\Managers;

use App\Filters\UndercoverMembersFilters;
use App\Models\Members;
use App\Models\Undercover;
use App\Models\UndercoverMembers;
use App\Models\UndercoverWords;
use App\Repositories\UndercoverRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class UndercoverManager extends CommonManager
{
    public function __construct(UndercoverRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return int|string
     */
    public function create(): int|string
    {
        try {
            $uniqId = uniqid();
            $lastId = UndercoverWords::max('id');

            $words_id = rand(1, $lastId);

            $undercover = new Undercover(['creator' => $uniqId, 'undercover_words_id' => $words_id, 'games_id' => 1]);

            $this->repository->create($undercover);
            return $undercover->id;
        } catch (Exception $exception){
            Log::error($e->getMessage());
            return 0;
        }
    }

    /**
     * @param UndercoverMembersFilters $filters
     * @param int $undercoverId
     * @return Members|bool
     */
    public function newMember(UndercoverMembersFilters $filters, int $undercoverId): Members | bool
    {
        try {
            $member = new Members(['roles_id' => $filters->role_id, 'name' => $undercoverId.'_'. $filters->name]);
            $member->save();
            return $member;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param UndercoverMembersFilters $filters
     * @param int $undercoverId
     * @param int $memberId
     * @return bool
     */
    public function newUndercoverMember(UndercoverMembersFilters $filters, int $memberId, int $undercoverId): bool
    {
        try {
            $word = '';
            if ($filters->word != null){
                $word = $filters->word;
            }
            $memberUndercover = new UndercoverMembers(['word' => $word, 'members_id' => $memberId, 'undercover_id' => $undercoverId]);
            $memberUndercover->save();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param int $undercoverId
     * @return bool
     */
    public function delete(int $undercoverId): bool
    {
        try {
            Undercover::find($undercoverId)->delete();
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param int $undercoverMemberId
     * @return bool
     */
    public function deleteMember(int $undercoverMemberId): bool
    {
        try {
            // TODO: pour la feature du groupe penser à supprimer uniquement le undercoverMembers
            $memberId = UndercoverMembers::find($undercoverMemberId)->members_id;
            Members::find($memberId)->delete();
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
