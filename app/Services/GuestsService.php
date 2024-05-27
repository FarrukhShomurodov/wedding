<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GuestsService
{
    public function fetch(): Collection
    {
        return Guest::all();
    }

    public function store($validated): Model|Builder
    {
        $guest = Guest::query()->create($validated);
        $guest->wedding()->attach($validated['wedding_id']);

        return $guest;
    }
}
