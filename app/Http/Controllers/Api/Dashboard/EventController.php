<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\Wedding;
use App\Repositories\EventRepository;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    protected EventService $eventService;
    protected EventRepository $eventRepository;

    public function __construct(EventService $eventService, EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->eventService = $eventService;
    }

    public function fetchByWedding(Wedding $wedding): AnonymousResourceCollection
    {
        $histories = $this->eventRepository->weddingEvent($wedding);
        return EventResource::collection($histories);
    }

    public function show(Event $Event): EventResource
    {
        $Event = $this->eventRepository->show($Event);
        return EventResource::make($Event);
    }

    public function store(StoreRequest $request): EventResource
    {
        $Event = $this->eventService->store($request->validated());

        return EventResource::make($Event);
    }


    public function update(Event $Event, UpdateRequest $request): EventResource
    {
        $Event = $this->eventService->update($Event, $request->validated());

        return EventResource::make($Event);
    }

    public function destroy(Event $Event): JsonResponse
    {
        $this->eventService->destroy($Event);

        return response()->json([], 204);
    }
}
