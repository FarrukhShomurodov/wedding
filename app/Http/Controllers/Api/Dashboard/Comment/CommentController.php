<?php

namespace App\Http\Controllers\Api\Dashboard\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment\Comment;
use App\Models\Wedding;
use App\Repositories\Comment\CommentRepository;
use App\Services\Comment\CommentService;
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

    public function fetchByWedding(Wedding $wedding): AnonymousResourceCollection
    {
        $histories = $this->commentRepository->weddingComment($wedding);
        return CommentResource::collection($histories);
    }

    public function countByWedding($weddingId): int
    {
        return $this->commentRepository->count($weddingId);
    }

    public function store(StoreRequest $request): CommentResource
    {
        $comment = $this->commentService->store($request->validated());

        return CommentResource::make($comment);
    }


    public function update(Comment $comment, UpdateRequest $request): CommentResource
    {
        $comment = $this->commentService->update($comment, $request->validated());

        return CommentResource::make($comment);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $this->commentService->destroy($comment);

        return response()->json([], 204);
    }
}
