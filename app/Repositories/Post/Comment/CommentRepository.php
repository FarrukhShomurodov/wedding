<?php

namespace App\Repositories\Post\Comment;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    function postComment(Post $post): Collection
    {
        return $post->comments()->get();
    }

}
