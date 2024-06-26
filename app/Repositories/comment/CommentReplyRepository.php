<?php

namespace App\Repositories\comment;

use App\Models\Comment\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentReplyRepository
{
    function commentReplay(Comment $comment): Collection
    {
        return $comment->commentReplay()->get();
    }
}
