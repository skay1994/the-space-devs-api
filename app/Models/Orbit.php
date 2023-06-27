<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orbit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'abbrev'
    ];

    public function missions(): HasMany
    {
        return $this->hasMany(Mission::class);
    }
}
