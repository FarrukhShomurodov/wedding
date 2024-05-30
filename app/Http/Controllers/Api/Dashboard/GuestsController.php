<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\Guest\UpdateRequest;
use App\Http\Resources\GuestsResource;
use App\Models\Guest;
use App\Repositories\GuestRepository;
use App\Services\GuestsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GuestsController extends Controller
{
    protected GuestsService $guestService;
    protected GuestRepository $guestRepository;

    public function __construct(GuestRepository $guestRepository, GuestsService $guestService)
    {
        $this->guestRepository = $guestRepository;
        $this->guestService = $guestService;
    }

    public function index(): AnonymousResourceCollection
    {
        $guests = $this->guestRepository->getAll();
        return GuestsResource::collection($guests);
    }

    public function store(StoreRequest $request): GuestsResource
    {
        $guest = $this->guestService->store($request->validated());

        return GuestsResource::make($guest);
    }

    public function update(Guest $guest, UpdateRequest $request): GuestsResource
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
