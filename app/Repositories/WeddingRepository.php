<?php

namespace App\Repositories;

use App\Models\Wedding;
use Carbon\Carbon;
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

    public function remains($wedding): array
    {
        $now = Carbon::now()->toDateTimeString();
        $weddingDate = Carbon::parse($wedding->date_time);
        $diff = $weddingDate->diff($now);
        return [
            'days' => $diff->days,
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s
        ];
    }
}
