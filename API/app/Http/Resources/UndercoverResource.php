<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UndercoverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request) :array
    {
        return [
            'id' => $this->id,
            'members' => UndercoverMembersResource::collection($this->members),
            'words' => UndercoverWordsResource::make($this->words),
        ];
    }
}
