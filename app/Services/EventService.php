<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EventService
{
    public function store($validated): Builder|Model
    {
        return Event::query()->create($validated);
    }

    public function update(Event $event, $validated): Event
    {
        $event->update($validated);

        return $event->refresh();
    }

    public function destroy(Event $event): void
    {
        $event->delete();
    }
}
