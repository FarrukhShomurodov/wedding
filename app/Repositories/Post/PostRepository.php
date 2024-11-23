<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    public function get(): Collection
    {
        return Post::all();
    }

    public function show(Post $post): Post
    {
        return $post;
    }

    public function byCategory(PostCategory $postCategory): Collection
    {
        return $postCategory->post()->get();
    }

}
