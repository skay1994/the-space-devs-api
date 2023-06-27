<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Launch extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'status', 'url', 'launch_library_id', 'rocket_id', 'launch_provider_id', 'name', 'slug', 'net', 'window_start', 'window_end',
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

    public function provider(): BelongsTo
    {
        return $this->belongsTo(LaunchServiceProvider::class, 'launch_provider_id');
    }

    public function rocket(): BelongsTo
    {
        return $this->belongsTo(Rocket::class);
    }
}
