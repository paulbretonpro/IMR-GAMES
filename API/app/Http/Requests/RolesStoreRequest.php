<?php

namespace App\Http\Requests;

class RolesStoreRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return parent::authorize();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ];
    }
}
