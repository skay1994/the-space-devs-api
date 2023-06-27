<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'url', 'name', 'country_code', 'map_image', 'total_launch_count', 'total_landing_count',
    ];

    protected $casts = [
        'total_launch_count' => 'integer',
        'total_landing_count' => 'integer',
    ];
}
