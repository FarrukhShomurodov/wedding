<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'started_date' => $this->started_date,
            'ended_date' => $this->ended_date,
            'description' => $this->description,
            'background_url' => $this->background_url,
            'wedding' => WeddingResource::make($this->wedding)
        ];
    }
}
