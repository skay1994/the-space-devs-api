<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Launch extends Model
{
    protected $fillable = [
        'uuid', 'status', 'url', 'launch_library_id', 'name', 'slug', 'net', 'window_start', 'window_end',
        'inhold', 'tbdtime', 'tbddate', 'probability', 'holdreason', 'failreason', 'hashtag', 'webcast_live',
        'image', 'infographic', 'program'
    ];

    protected $casts = [
        'inhold' => 'boolean',
        'webcast_live' => 'boolean',
        'status' => Status::class,
        'net' => 'datetime',
        'window_start' => 'datetime',
        'window_end' => 'datetime',
        'tbdtime' => 'datetime',
        'tbddate' => 'datetime',
    ];
}
