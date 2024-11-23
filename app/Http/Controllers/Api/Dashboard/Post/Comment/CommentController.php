<?php

namespace App\Http\Controllers\Api\Dashboard\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Post;
use App\Models\PostComment;
use App\Repositories\Post\Comment\CommentRepository;
use App\Services\Post\Comment\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    protected CommentService $commentService;
    protected CommentRepository $commentRepository;

    public function __construct(CommentService $commentService, CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    public function fetchByWedding(Post $post): AnonymousResourceCollection
    {
        $histories = $this->commentRepository->postComment($post);
        return CommentResource::collection($histories);
    }

    public function store(PostCommentRequest $request): CommentResource
    {
        $comment = $this->commentService->store($request->validated());

        return CommentResource::make($comment);
    }


    public function update(PostComment $postComment, PostCommentRequest $request): CommentResource
    {
        $postComment = $this->commentService->update($postComment, $request->validated());

        return CommentResource::make($postComment);
    }

    public function destroy(PostComment $postComment): JsonResponse
    {
        $this->commentService->destroy($postComment);

        return response()->json([], 204);
    }
}
