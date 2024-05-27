<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make($this->user),
            'groom_name' => $this->groom_name,
            'bridge_name' => $this->bridge_name,
            'date' => $this->date,
            'location' => $this->location,
            'information_later'=> $this->information_later
        ];
    }
}
