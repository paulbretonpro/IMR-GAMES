<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamesStoreRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return parent::authorize();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'rule' => 'required|string'
        ];
    }
}
