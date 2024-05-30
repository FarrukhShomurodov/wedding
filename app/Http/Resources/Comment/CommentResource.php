<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\WeddingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'full_name' => $this->full_name,
            'text' => $this->message,
            'date' => $this->date,
            'wedding' => WeddingResource::make($this->wedding),
        ];
    }
}
