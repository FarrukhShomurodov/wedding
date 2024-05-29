<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingRequest;
use App\Http\Resources\WeddingResource;
use App\Models\Wedding;
use App\Services\WeddingService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WeddingController extends Controller
{
    protected WeddingService $weddingServive;

    public function __construct(WeddingService $weddingService)
    {
        $this->weddingServive = $weddingService;
    }

    public function index(): AnonymousResourceCollection
    {
        $wedding = $this->weddingServive->fetch();
        return WeddingResource::collection($wedding);
    }

    public function show(Wedding $wedding): WeddingResource
    {
        return WeddingResource::make($wedding);
    }

    public function store(WeddingRequest $request): WeddingResource
    {
        $wedding = $this->weddingServive->store($request->validated());

        return WeddingResource::make($wedding);
    }

    public function update(Wedding $wedding, WeddingRequest $request): WeddingResource
    {
        $weddingUpdated = $this->weddingServive->update($wedding, $request->validated());

        return WeddingResource::make($weddingUpdated);
    }
}
