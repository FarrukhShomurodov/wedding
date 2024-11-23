<?php

namespace App\Repositories\Post;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Collection;

class PostCategoryRepository
{
    public function get(): Collection
    {
        return PostCategory::all();
    }

    public function show(PostCategory $postCategory): PostCategory
    {
        return $postCategory;
    }
}
