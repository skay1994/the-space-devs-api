<?php

namespace App\Http\Resources;

use App\Models\Launch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Launch */
class LaunchListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->getKey(),
            'provider_name' => $this->provider->name,
            'rocket_name' => $this->rocket->name,
            'name' => $this->name,
            'slug' => $this->slug,
            'status_name' => $this->status->name(),
            'webcast_live' => $this->webcast_live,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
