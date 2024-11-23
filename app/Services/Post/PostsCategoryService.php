<?php

namespace App\Services\Post;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PostsCategoryService
{
    public function store($validated): Builder|Model
    {
        return PostCategory::query()->create($validated);
    }

    public function update(PostCategory $postCategory, $validated): PostCategory
    {
        $postCategory->update($validated);

        return $postCategory->refresh();
    }

    public function destroy(PostCategory $postCategory): void
    {
        $postCategory->delete();
    }
}
