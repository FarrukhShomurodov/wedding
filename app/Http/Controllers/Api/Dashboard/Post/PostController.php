<?php

namespace App\Http\Controllers\Api\Dashboard\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Models\PostCategory;
use App\Repositories\Post\PostRepository;
use App\Services\Post\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    protected PostService $postService;
    protected PostRepository $postRepository;

    public function __construct(PostService $postService, PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->postService = $postService;
    }

    public function byCategory(PostCategory $postCategory): AnonymousResourceCollection
    {
        $postCategory = $this->postRepository->byCategory($postCategory);
        return PostResource::collection($postCategory);
    }

    public function index(): AnonymousResourceCollection
    {
        $posts = $this->postRepository->get();
        return PostResource::collection($posts);
    }


    public function show(Post $post): PostResource
    {
        $post = $this->postRepository->show($post);
        return PostResource::make($post);
    }

    public function store(PostRequest $request): PostResource
    {
        $post = $this->postService->store($request->validated());
        return PostResource::make($post);
    }

    public function update(Post $post, PostRequest $request): PostResource
    {
        $post = $this->postService->update($post, $request->validated());

        return PostResource::make($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->postService->destroy($post);

        return response()->json([], 204);
    }
}
