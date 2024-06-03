<?php

namespace App\Repositories;

use App\Models\Comment\Comment;
use App\Models\Wedding;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    function weddingComment(Wedding $wedding): Collection
    {
        return $wedding->comment()->get();
    }

    function count($weddingId): int
    {
        return Comment::query()->where('wedding_id', $weddingId)->count();
    }
}
