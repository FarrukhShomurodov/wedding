<?php

namespace App\Services\Post\Comment;

use App\Models\PostCommentReply;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentReplyService
{
    public function store($validated): Builder|Model
    {
        return PostCommentReply::query()->create($validated);
    }

    public function update(PostCommentReply $postCommentReply, $validated): PostCommentReply
    {
        $postCommentReply->update($validated);

        return $postCommentReply->refresh();
    }

    public function destroy(PostCommentReply $postCommentReply): void
    {
        $postCommentReply->delete();
    }

}
