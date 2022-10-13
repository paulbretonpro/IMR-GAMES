<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UndercoverStoreRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return parent::authorize();
    }

    public function rules(): array
    {
        return [
            'id' => 'required|string'
        ];
    }
}
