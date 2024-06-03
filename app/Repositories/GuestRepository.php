<?php

namespace App\Repositories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GuestRepository
{
    public function getAll(): Collection
    {
        return Guest::all();
    }

    public function count($weddingId): int
    {
        return DB::table('wedding_guests')->where('wedding_id',$weddingId)->get('guest_id')->count();
    }
}
