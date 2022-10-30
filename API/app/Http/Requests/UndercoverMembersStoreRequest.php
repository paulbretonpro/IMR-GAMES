<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UndercoverMembersStoreRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return parent::authorize();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'role_id' => 'required|int',
            'word' => 'sometimes|string|nullable'
        ];
    }
}
