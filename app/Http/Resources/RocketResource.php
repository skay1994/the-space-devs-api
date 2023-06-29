<?php

namespace App\Http\Resources;

use App\Models\Rocket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Rocket
 */
class RocketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'name' => $this->name,
            'family' => $this->family,
            'variant' => $this->variant,
            'configuration' => $this->configuration,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
