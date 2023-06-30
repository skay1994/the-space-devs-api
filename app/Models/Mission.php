<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'orbit_id', 'launch_library_id', 'name', 'description', 'launch_designator', 'type'
    ];

    public function orbit(): BelongsTo
    {
        return $this->belongsTo(Orbit::class);
    }

    public function launch(): BelongsTo
    {
        return $this->belongsTo(Launch::class);
    }
}
