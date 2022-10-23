<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Members extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'roles_id'
    ];


    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Roles::class, 'id', 'roles_id');
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        $name = explode('_', $this->name);
        return $name[1];
    }
}
