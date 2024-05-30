<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentReplyRepository
{
    function commentReplay(Comment $comment): Collection
    {
        return $comment->commentReplay()->get();
    }
}
