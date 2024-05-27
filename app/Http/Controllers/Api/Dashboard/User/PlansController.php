<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlansResource;
use App\Services\PlansService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlansController extends Controller
{
    protected $planService;

    public function __construct(PlansService $planService)
    {
        $this->planService = $planService;
    }

    public function index(): AnonymousResourceCollection
    {
        $plans = $this->planService->fetch();
        return PlansResource::collection($plans);
    }
}
