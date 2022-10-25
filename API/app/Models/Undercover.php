<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Undercover extends Model
{
    use HasFactory;

    protected $table = 'undercover';

    protected $fillable = [
        'id',
        'creator',
        'games_id',
        'undercover_words_id'
    ];

    /**
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(UndercoverMembers::class);
    }

    /**
     * @return HasOne
     */
    public function words(): HasOne
    {
        return $this->hasOne(UndercoverWords::class, 'id', 'undercover_words_id');
    }

}
