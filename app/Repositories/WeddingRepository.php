<?php

namespace App\Repositories;

use App\Models\Wedding;
use Illuminate\Database\Eloquent\Collection;

class WeddingRepository
{
    public function getAll(): Collection
    {
        return Wedding::all();
    }

    public function show(Wedding $wedding): Wedding
    {
        return $wedding;
    }
}
