<?php

namespace App\Http\Resources;

use App\Models\Launch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Launch
 */
class LaunchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->getKey(),
            'provider' => new LaunchServiceProviderResource($this->provider),
            'rocket' => new RocketResource($this->rocket),
            'name' => $this->name,
            'slug' => $this->slug,
            'net' => $this->net,
            'status' => $this->status,
            'status_name' => $this->status->name(),
            'window_start' => $this->window_start,
            'window_end' => $this->window_end,
            'inhold' => $this->inhold,
            'tbdtime' => $this->tbdtime,
            'tbddate' => $this->tbddate,
            'probability' => $this->probability,
            'holdreason' => $this->holdreason,
            'failreason' => $this->failreason,
            'hashtag' => $this->hashtag,
            'webcast_live' => $this->webcast_live,
            'image' => $this->image,
            'infographic' => $this->infographic,
            'program' => $this->program,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
