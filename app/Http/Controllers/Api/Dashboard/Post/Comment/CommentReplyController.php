<?php

namespace App\Http\Controllers\Api\Dashboard\Post\Comment;


use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCommentReplyRequest;
use App\Http\Resources\Comment\CommentReplyResource;
use App\Models\PostComment;
use App\Models\PostCommentReply;
use App\Repositories\Post\Comment\CommentReplyRepository;
use App\Services\Post\Comment\CommentReplyService;
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

    public function fetchByComment(PostComment $postComment): AnonymousResourceCollection
    {
        $commentReplay = $this->commentReplyRepository->commentReplay($postComment);
        return CommentReplyResource::collection($commentReplay);
    }

    public function store(PostCommentReplyRequest $request): CommentReplyResource
    {
        $history = $this->commentReplyService->store($request->validated());

        return CommentReplyResource::make($history);
    }


    public function update(PostCommentReply $postCommentReply, PostCommentReplyRequest $request): CommentReplyResource
    {
        $comment = $this->commentReplyService->update($postCommentReply, $request->validated());

        return CommentReplyResource::make($comment);
    }

    public function destroy(PostCommentReply $postCommentReply): JsonResponse
    {
        $this->commentReplyService->destroy($postCommentReply);

        return response()->json([], 204);
    }
}
