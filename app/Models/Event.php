<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function event_users(): HasMany
    {
        return $this->hasMany(EventUser::class);
    }

    //--- ci-dessous : vers USERS la manière "belongsToMany", qui devrait simplifier la tâche et utiliser directement la table intermédiaire
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_users', 'event_id', 'user_id');
    }
}
