<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description'
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class, 'subscriptions', 'plan_id', 'user_id');
    }
}
