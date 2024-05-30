<?php

namespace App\Services;

use App\Models\CommentReply;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentReplyService
{
    public function store($validated): Builder|Model
    {
        return CommentReply::query()->create($validated);
    }

    public function update(CommentReply $commentReply, $validated): CommentReply
    {
        $commentReply->update($validated);

        return $commentReply->refresh();
    }

    public function destroy(CommentReply $comment): void
    {
        $comment->delete();
    }

}
