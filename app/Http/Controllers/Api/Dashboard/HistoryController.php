<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\History\StoreRequest;
use App\Http\Requests\History\UpdateRequest;
use App\Http\Resources\HistoryResource;
use App\Models\History;
use App\Models\Wedding;
use App\Repositories\HistoryRepository;
use App\Services\HistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HistoryController extends Controller
{
    protected HistoryService $historyService;
    protected HistoryRepository $historyRepository;

    public function __construct(HistoryService $historyService, HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
        $this->historyService = $historyService;
    }

    public function fetchByWedding(Wedding $wedding): AnonymousResourceCollection
    {
        $histories = $this->historyRepository->weddingHistory($wedding);
        return HistoryResource::collection($histories);
    }

    public function show(History $history): HistoryResource
    {
        $history = $this->historyRepository->show($history);
        return HistoryResource::make($history);
    }

    public function store(StoreRequest $request): HistoryResource
    {
        $history = $this->historyService->store($request->validated());

        return HistoryResource::make($history);
    }


    public function update(History $history, UpdateRequest $request): HistoryResource
    {
        $history = $this->historyService->update($history, $request->validated());

        return HistoryResource::make($history);
    }

    public function destroy(History $history): JsonResponse
    {
        $this->historyService->destroy($history);

        return response()->json([], 204);
    }
}
