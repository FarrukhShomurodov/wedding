<?php

namespace App\Repositories;

use App\Http\Controllers\Api\Dashboard\HistoryController;
use App\Models\History;
use App\Models\Wedding;
use Illuminate\Database\Eloquent\Collection;

class HistoryRepository
{
    function weddingHistory(Wedding $wedding): Collection
    {
        return $wedding->history()->get();
    }

    function show(History $history)
    {
        return $history;
    }
}
