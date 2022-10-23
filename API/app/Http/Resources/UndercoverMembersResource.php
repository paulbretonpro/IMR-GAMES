<?php
namespace App\Http\Resources;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UndercoverMembersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request) :array
    {
        $member = $this->member;
        return [
            'id' => $this->id,
            'name' => $member->getName(),
            'role' => $member->role->name,
            'word' => $this->word,
        ];
    }
}
