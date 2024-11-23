<?php

namespace App\Http\Controllers\Api\Dashboard\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCategoryRequest;
use App\Http\Resources\Post\PostCategoryResource;
use App\Models\PostCategory;
use App\Repositories\Post\PostCategoryRepository;
use App\Services\Post\PostsCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostCategoryController extends Controller
{
    protected PostsCategoryService $postsCategoryService;
    protected PostCategoryRepository $postCategoryRepository;

    public function __construct(PostsCategoryService $postsCategoryService, PostCategoryRepository $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
        $this->postsCategoryService = $postsCategoryService;
    }


    public function index(): AnonymousResourceCollection
    {
        $posts = $this->postCategoryRepository->get();
        return PostCategoryResource::collection($posts);
    }


    public function show(PostCategory $postCategory): PostCategoryResource
    {
        $postCategory = $this->postCategoryRepository->show($postCategory);
        return PostCategoryResource::make($postCategory);
    }

    public function store(PostCategoryRequest $request): PostCategoryResource
    {
        $post = $this->postsCategoryService->store($request->validated());
        return PostCategoryResource::make($post);
    }

    public function update(PostCategory $postCategory, PostCategoryRequest $request): PostCategoryResource
    {
        $postCategory = $this->postsCategoryService->update($postCategory, $request->validated());

        return PostCategoryResource::make($postCategory);
    }

    public function destroy(PostCategory $postCategory): JsonResponse
    {
        $this->postsCategoryService->destroy($postCategory);

        return response()->json([], 204);
    }
}
