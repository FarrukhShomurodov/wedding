<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GuestsService
{
    public function store($validated): Model|Builder
    {
        $guest = Guest::query()->create($validated);
        $guest->wedding()->attach($validated['wedding_id']);

        return $guest;
    }

    public function update(Guest $guest, $validated): Guest
    {
        $guest->update($validated);

        return $guest->refresh();
    }

    public function destroy(Guest $guest): void
    {
        $guest->wedding()->detach($guest['wedding_id']);
        $guest->delete();
    }
}
