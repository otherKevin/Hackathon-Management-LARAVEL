<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Lien vers la table des utilisateurs "users"
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Lien vers la table des événements "events"
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
