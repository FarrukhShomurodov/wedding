<?php

namespace App\Services\Comment;

use App\Models\Comment\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentService
{
    public function store($validated): Model|Builder
    {
        return Comment::query()->create($validated);
    }

    public function update(Comment $comment, $validated): Comment
    {
        $comment->update($validated);

        return $comment->refresh();
    }

    public function destroy(Comment $comment): void
    {
        $comment->delete();
    }
}
