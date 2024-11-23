<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'title_description',
        'image_url',
        'description',
        'post_category_id'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(PostCategory::class);
    }

    public function comments(): BelongsTo
    {
        return $this->belongsTo(PostComment::class);
    }
}
