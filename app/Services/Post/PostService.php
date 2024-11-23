<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PostService
{
    public function store($validated): Builder|Model
    {
        return Post::query()->create($validated);
    }

    public function update(Post $post, $validated): Post
    {
        $post->update($validated);

        return $post->refresh();
    }

    public function destroy(Post $post): void
    {
        $post->delete();
    }
}
