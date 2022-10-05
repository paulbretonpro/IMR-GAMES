<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\ArrayShape;

class GamesUpdateRequest extends CommonRequest
{
    /**
     * @return string[]
     */
    #[ArrayShape([
        'name' => "string",
        'rule' => "string"
    ])]
    public function rules(): array
    {
        return [
            'name' => 'required|sometimes|string|max:100',
            'rule' => 'required|sometimes|string'
        ];
    }
}
