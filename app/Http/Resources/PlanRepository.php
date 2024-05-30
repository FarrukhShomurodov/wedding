<?php

namespace App\Http\Resources;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

class PlanRepository
{
    public function getAll(): Collection
    {
        return Plan::all();
    }
}
