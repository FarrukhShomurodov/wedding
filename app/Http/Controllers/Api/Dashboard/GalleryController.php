<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\StoreRequest;
use App\Http\Requests\Gallery\UpdateRequest;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Models\Wedding;
use App\Repositories\GalleryRepository;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GalleryController extends Controller
{
    protected GalleryService $galleryService;
    protected GalleryRepository $galleryRepository;

    public function __construct(GalleryService $galleryService, GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
        $this->galleryService = $galleryService;
    }

    public function fetchByWedding(Wedding $wedding): AnonymousResourceCollection
    {
        $histories = $this->galleryRepository->weddingGallery($wedding);
        return GalleryResource::collection($histories);
    }

    public function show(Gallery $gallery): GalleryResource
    {
        $gallery = $this->galleryRepository->show($gallery);
        return GalleryResource::make($gallery);
    }

    public function store(StoreRequest $request): GalleryResource
    {
        $Event = $this->galleryService->store($request->validated());

        return GalleryResource::make($Event);
    }


    public function update(Gallery $gallery, UpdateRequest $request): GalleryResource
    {
        $gallery = $this->galleryService->update($gallery, $request->validated());

        return GalleryResource::make($gallery);
    }

    public function destroy(Gallery $gallery): JsonResponse
    {
        $this->galleryService->destroy($gallery);

        return response()->json([], 204);
    }
}
