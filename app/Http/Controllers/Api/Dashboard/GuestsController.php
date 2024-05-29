<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\GuestsRequest;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Http\Resources\GuestsResource;
use App\Models\Guest;
use App\Services\GuestsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GuestsController extends Controller
{
    protected GuestsService $guestService;

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
        $guest = $this->guestService->store($request->validated());

        return GuestsResource::make($guest);
    }

    public function update(Guest $guest, UpdateGuestRequest $request): GuestsResource
    {
        $guest = $this->guestService->update($guest, $request->validated());

        return GuestsResource::make($guest);
    }

    public function destroy(Guest $guest): JsonResponse
    {
        $this->guestService->destroy($guest);

        return response()->json([], 204);
    }
}
