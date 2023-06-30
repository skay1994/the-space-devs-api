<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'location_id', 'url', 'agency_id', 'name', 'info_url', 'map_url', 'wiki_url', 'latitude',
        'longitude', 'map_image', 'total_launch_count'
    ];

    protected $casts = [
        'agency_id' => 'integer',
        'total_launch_count' => 'integer',
    ];

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function launchers(): HasMany
    {
        return $this->hasMany(Launch::class);
    }
}
