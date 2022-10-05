<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rule'
    ];

    protected $primaryKey = 'id';

    /**
     * @return HasMany
     */
    public function roles() :HasMany
    {
        return $this->hasMany(Roles::class);
    }
}
