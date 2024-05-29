<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'groom_name',
            'bridge_name',
            'date',
            'location',
            'information_later',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guest(): BelongsToMany
    {
        return $this->belongsToMany(Guest::class, 'guest_id', 'wedding_guests', 'wedding_id');
    }

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

