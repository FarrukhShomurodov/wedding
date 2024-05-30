<?php

namespace App\Repositories;

use App\Models\Wedding;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{
    function weddingComment(Wedding $wedding): Collection
    {
        return $wedding->comment()->get();
    }
}
