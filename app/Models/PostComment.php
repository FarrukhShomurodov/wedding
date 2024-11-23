<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'text',
        'date',
        'post_id'
    ];

    public function post(): HasOne
    {
        return $this->hasOne(Post::class);
    }

    public function commentReplay(): BelongsTo
    {
        return $this->belongsTo(PostCommentReply::class);
    }
}
