<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rocket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'family', 'variant', 'configuration'
    ];

    protected $casts = [
        'configuration' => 'array'
    ];

    public function launchers(): HasMany
    {
        return $this->hasMany(Launch::class);
    }
}
