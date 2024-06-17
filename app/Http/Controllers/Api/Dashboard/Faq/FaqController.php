<?php

namespace App\Http\Controllers\Api\Dashboard\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\FaqRequest;
use App\Http\Resources\Faq\FaqResource;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Repositories\Faq\FaqRepository;
use App\Services\Faq\FaqService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqController extends Controller
{
    protected FaqService $faqService;
    protected FaqRepository $faqRepository;

    public function __construct(FaqService $faqService, FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
        $this->faqService = $faqService;
    }

    public function byCategory(FaqCategory $faqCategory): AnonymousResourceCollection
    {
        $faq = $this->faqRepository->byCategory($faqCategory);
        return FaqResource::collection($faq);
    }

    public function index(): AnonymousResourceCollection
    {
        $faqs = $this->faqRepository->get();
        return FaqResource::collection($faqs);
    }

    public function show(Faq $faq): FaqResource
    {
        $faq = $this->faqRepository->show($faq);
        return FaqResource::make($faq);
    }

    public function store(FaqRequest $request): FaqResource
    {
        $faq = $this->faqService->store($request->validated());
        return FaqResource::make($faq);
    }

    public function update(Faq $faq, FaqRequest $request): FaqResource
    {
        $faq = $this->faqService->update($faq, $request->validated());

        return FaqResource::make($faq);
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $this->faqService->destroy($faq);

        return response()->json([], 204);
    }
}
