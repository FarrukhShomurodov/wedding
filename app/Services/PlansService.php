<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

class PlansService
{
    public function fetchPlans(): Collection
    {
        return Plan::all();
    }
}
