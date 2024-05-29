<?php

namespace App\Services;

use App\Models\History;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HistoryService
{
    public function store($validated): Model|Builder
    {
        return History::query()->create($validated);
    }

    public function update(History $history, $validated): History
    {
        $history->update($validated);

        return $history->refresh();
    }

    public function destroy(History $history): void
    {
        $history->delete();
    }
}
