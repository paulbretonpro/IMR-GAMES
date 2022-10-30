<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class GamesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    #[ArrayShape(['id' => "int", 'name' => "string", 'rule' => "string", 'roles' => "App\\Http\\Resources\\RolesResource"])]
    public function toArray($request) :array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rule' => $this->rule,
            'roles' => RolesResource::collection($this->roles),
            'code' => $this->code,
        ];
    }
}
