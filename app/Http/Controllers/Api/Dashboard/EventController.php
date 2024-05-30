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

    public function show(Event $event): EventResource
    {
        $event = $this->eventRepository->show($event);

        if($event)
            return EventResource::make($event);
        else
            abort(204, 'Event not found');
    }

    public function store(StoreRequest $request): EventResource
    {
        $Event = $this->eventService->store($request->validated());

        return EventResource::make($Event);
    }


    public function update(Event $event, UpdateRequest $request): EventResource
    {
        $event = $this->eventService->update($event, $request->validated());

        return EventResource::make($event);
    }

    public function destroy(Event $event): JsonResponse
    {
        $this->eventService->destroy($event);

        return response()->json([], 204);
    }
}
