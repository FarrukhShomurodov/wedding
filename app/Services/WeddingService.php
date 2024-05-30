<?php

namespace App\Services;

use App\Models\Wedding;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class WeddingService
{
    public function store($validated): Model|Builder
    {
        return Wedding::query()->create($validated);
    }

    public function update(Wedding $wedding, $validated): Wedding
    {
        $wedding->update($validated);

        return $wedding->refresh();
    }
}
