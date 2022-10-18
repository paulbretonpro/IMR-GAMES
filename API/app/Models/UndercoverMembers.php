<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UndercoverMembers extends Model
{
    use HasFactory;

    protected $table = 'undercover_members';

    protected $fillable = [
        'undercover_id',
        'members_id',
        'word',
    ];

    /**
     * @return HasOne
     */
    public function member(): HasOne
    {
        return $this->hasOne(Members::class, 'id', 'members_id');
    }
}
