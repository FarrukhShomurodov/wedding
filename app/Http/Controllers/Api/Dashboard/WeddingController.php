<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingRequest;
use App\Http\Resources\WeddingResource;
use App\Models\Wedding;
use App\Repositories\WeddingRepository;
use App\Services\WeddingService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WeddingController extends Controller
{
    protected WeddingService $weddingServive;
    protected WeddingRepository $weddingRepository;

    public function __construct(WeddingService $weddingService, WeddingRepository $weddingRepository)
    {
        $this->weddingServive = $weddingService;
        $this->weddingRepository = $weddingRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $wedding = $this->weddingRepository->getAll();
        return WeddingResource::collection($wedding);
    }

    public function show(Wedding $wedding): WeddingResource
    {
        $wedding = $this->weddingRepository->show($wedding);

        if ($wedding)
            return WeddingResource::make($wedding);
        else
            abort(204, 'Wedding not found');
    }

    public function store(WeddingRequest $request): WeddingResource
    {
        $wedding = $this->weddingServive->store($request->validated());

        return WeddingResource::make($wedding);
    }

    public function update(Wedding $wedding, WeddingRequest $request): WeddingResource
    {
        $wedding = $this->weddingServive->update($wedding, $request->validated());

        return WeddingResource::make($wedding);
    }
}
