<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UndercoverWordsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "integer", 'fake' => "string", 'good' => "string"])]
    public function toArray($request) :array
    {
        return [
            'id' => $this->id,
            'fake' => $this->fake,
            'good' => $this->good,
        ];
    }
}
