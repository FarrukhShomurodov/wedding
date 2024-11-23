<?php

namespace App\Repositories\Post\Comment;

use App\Models\PostComment;
use Illuminate\Database\Eloquent\Collection;

class CommentReplyRepository
{
    function commentReplay(PostComment $postComment): Collection
    {
        return $postComment->commentReplay()->get();
    }
}
