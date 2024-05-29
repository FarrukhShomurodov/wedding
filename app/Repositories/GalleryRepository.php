<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Wedding;
use Illuminate\Database\Eloquent\Collection;

class GalleryRepository
{
    function weddingGallery(Wedding $wedding): Collection
    {
        return $wedding->gallery()->get();
    }

    function show(Event $event): Event
    {
        return $event;
    }
}
