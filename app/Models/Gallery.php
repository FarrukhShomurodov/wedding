<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_url',
        'date',
        'wedding_id'
    ];

    protected function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}
