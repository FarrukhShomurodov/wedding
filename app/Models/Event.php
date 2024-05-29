<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'started_date',
        'ended_date',
        'description',
        'background_url',
        'wedding_id'
    ];

    protected function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}
