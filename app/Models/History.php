<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'wedding_id',
        'content_link'
    ];

    protected function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}
