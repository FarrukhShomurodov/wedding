<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostCommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'text',
        'post_comment_id'
    ];

    public function comment(): HasOne
    {
        return $this->hasOne(PostComment::class);
    }
}
