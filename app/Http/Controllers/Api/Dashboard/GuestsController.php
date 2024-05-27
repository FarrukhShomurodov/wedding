<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestsRequest;
use App\Http\Resources\GuestsResource;
use App\Services\GuestsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GuestsController extends Controller
{
    protected $guestService;

    public function __construct(GuestsService $guestService)
    {
        $this->guestService = $guestService;
    }

    public function index(): AnonymousResourceCollection
    {
        $guests = $this->guestService->fetch();
        return GuestsResource::collection($guests);
    }

    public function store(GuestsRequest $request): GuestsResource
    {
        $validated = $request->validated();
        $guest = $this->guestService->store($validated);

        return GuestsResource::make($guest);
    }
}
