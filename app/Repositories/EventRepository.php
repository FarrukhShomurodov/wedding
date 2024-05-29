<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Wedding;
use Illuminate\Database\Eloquent\Collection;

class EventRepository
{
    function weddingEvent(Wedding $wedding): Collection
    {
        return $wedding->event()->get();
    }

    function show(Event $event): Event
    {
        return $event;
    }
}
