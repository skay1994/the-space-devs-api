<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Launch extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid', 'status', 'url', 'launch_library_id', 'rocket_id', 'launch_provider_id', 'mission_id', 'pad_id',
        'name', 'slug', 'net', 'window_start', 'window_end', 'imported_t', 'inhold', 'tbdtime', 'tbddate',
        'probability', 'holdreason', 'failreason', 'hashtag', 'webcast_live', 'image', 'infographic', 'program'
    ];

    protected $casts = [
        'program' => 'json',
        'inhold' => 'boolean',
        'webcast_live' => 'boolean',
        'status' => Status::class,
        'net' => 'datetime:Y-m-d H:i:s',
        'window_start' => 'datetime:Y-m-d H:i:s',
        'window_end' => 'datetime:Y-m-d H:i:s',
        'tbdtime' => 'datetime:Y-m-d H:i:s',
        'tbddate' => 'datetime:Y-m-d H:i:s',
        'imported_t' => 'datetime:Y-m-d H:i:s',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(LaunchServiceProvider::class, 'launch_provider_id');
    }

    public function rocket(): BelongsTo
    {
        return $this->belongsTo(Rocket::class);
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }

    public function pad(): BelongsTo
    {
        return $this->belongsTo(Pad::class);
    }
}
