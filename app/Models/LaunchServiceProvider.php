<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaunchServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'url', 'name', 'type'
    ];

    public function launches(): HasMany
    {
        return $this->hasMany(Launch::class, 'launch_provider_id');
    }
}
