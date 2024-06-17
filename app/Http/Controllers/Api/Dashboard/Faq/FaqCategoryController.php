<?php

namespace App\Http\Controllers\Api\Dashboard\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\FaqCategoryRequest;
use App\Http\Resources\Faq\FaqResource;
use App\Models\FaqCategory;
use App\Repositories\Faq\FaqCategoryRepository;
use App\Services\Faq\FaqCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqCategoryController extends Controller
{
    protected FaqCategoryService $faqCategoryService;
    protected FaqCategoryRepository $faqCategoryRepository;

    public function __construct(FaqCategoryService $faqCategoryService, FaqCategoryRepository $faqCategoryRepository)
    {
        $this->faqCategoryRepository = $faqCategoryRepository;
        $this->faqCategoryService = $faqCategoryService;
    }

    public function index(): AnonymousResourceCollection
    {
        $faqs = $this->faqCategoryRepository->get();
        return FaqResource::collection($faqs);
    }

    public function show(FaqCategory $faqCategory): FaqResource
    {
        $faqCategory = $this->faqCategoryRepository->show($faqCategory);
        return FaqResource::make($faqCategory);
    }

    public function store(FaqCategoryRequest $request): FaqResource
    {
        $faq = $this->faqCategoryService->store($request->validated());
        return FaqResource::make($faq);
    }

    public function update(FaqCategory $faqCategory, FaqCategoryRequest $request): FaqResource
    {
        $faqCategory = $this->faqCategoryService->update($faqCategory, $request->validated());

        return FaqResource::make($faqCategory);
    }

    public function destroy(FaqCategory $faqCategory): JsonResponse
    {
        $this->faqCategoryService->destroy($faqCategory);

        return response()->json([], 204);
    }
}
