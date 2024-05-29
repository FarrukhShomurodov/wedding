<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
    ];

    public function wedding(): BelongsToMany
    {
        return $this->belongsToMany(Wedding::class, 'wedding_guests', 'guest_id','wedding_id');
    }
}
