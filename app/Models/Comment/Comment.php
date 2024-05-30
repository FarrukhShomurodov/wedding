<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'text',
        'date',
        'wedding_id'
    ];

    public function commentReplay(): HasMany
    {
        return $this->hasMany(CommentReply::class);
    }
}
