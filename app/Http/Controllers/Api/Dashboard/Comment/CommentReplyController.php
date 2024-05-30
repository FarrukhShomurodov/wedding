<?php

namespace App\Http\Controllers\Api\Dashboard\Comment;


use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentReplyRequest;
use App\Http\Resources\Comment\CommentReplyResource;
use App\Models\Comment\Comment;
use App\Models\Comment\CommentReply;
use App\Repositories\CommentReplyRepository;
use App\Services\Comment\CommentReplyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentReplyController extends Controller
{
    protected CommentReplyService $commentReplyService;
    protected CommentReplyRepository $commentReplyRepository;

    public function __construct(CommentReplyService $commentReplyService, CommentReplyRepository $commentReplyRepository)
    {
        $this->commentReplyRepository = $commentReplyRepository;
        $this->commentReplyService = $commentReplyService;
    }

    public function fetchByComment(Comment $comment): AnonymousResourceCollection
    {
        $commentReplay = $this->commentReplyRepository->commentReplay($comment);
        return CommentReplyResource::collection($commentReplay);
    }

    public function store(CommentReplyRequest $request): CommentReplyResource
    {
        $history = $this->commentReplyService->store($request->validated());

        return CommentReplyResource::make($history);
    }


    public function update(CommentReply $commentReply, CommentReplyRequest $request): CommentReplyResource
    {
        $comment = $this->commentReplyService->update($commentReply, $request->validated());

        return CommentReplyResource::make($comment);
    }

    public function destroy(CommentReply $commentReply): JsonResponse
    {
        $this->commentReplyService->destroy($commentReply);

        return response()->json([], 204);
    }
}
