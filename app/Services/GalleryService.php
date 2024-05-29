<?php

namespace App\Services;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GalleryService
{
    public function store($validated): Model|Builder
    {
        return Gallery::query()->create($validated);
    }

    public function update(Gallery $gallery, $validated): Gallery
    {
        $gallery->update($validated);

        return $gallery->refresh();
    }

    public function destroy(Gallery $gallery): void
    {
        $gallery->delete();
    }
}
