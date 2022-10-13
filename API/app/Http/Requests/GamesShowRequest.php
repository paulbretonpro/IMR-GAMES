<?php

namespace App\Http\Requests;

use App\Enums\CodeGames;
use Illuminate\Validation\Rule;

class GamesShowRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return parent::authorize();
    }

    public function rules(): array
    {
        return [];
    }
}
