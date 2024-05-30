<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanRepository;
use App\Http\Resources\PlansResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlansController extends Controller
{
    protected PlanRepository $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $plans = $this->planRepository->getAll();
        return PlansResource::collection($plans);
    }
}
