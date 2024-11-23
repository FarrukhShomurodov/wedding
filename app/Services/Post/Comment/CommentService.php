<?php

namespace App\Services\Post\Comment;

use App\Models\PostComment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentService
{
    public function store($validated): Model|Builder
    {
        return PostComment::query()->create($validated);
    }

    public function update(PostComment $postComment, $validated): PostComment
    {
        $postComment->update($validated);

        return $postComment->refresh();
    }

    public function destroy(PostComment $postComment): void
    {
        $postComment->delete();
    }
}
