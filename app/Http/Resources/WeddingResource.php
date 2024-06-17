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
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'groom_name' => $this->groom_name,
            'groom_information' => $this->groom_information,
            'bridge_name' => $this->bridge_name,
            'bridge_information' => $this->bridge_information,
            'date_time' => $this->date,
            'location' => $this->location,
            'information_later'=> $this->information_later,
            'bank_card_number'=> $this->bank_card_number
        ];
    }
}
