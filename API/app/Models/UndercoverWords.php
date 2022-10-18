<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UndercoverWords extends Model
{
    use HasFactory;

    protected $table = 'undercover_word';

    protected $primaryKey = 'id';

    protected $fillable = [
        'good',
        'fake'
    ];
}
