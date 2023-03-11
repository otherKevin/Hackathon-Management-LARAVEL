<?php

namespace App\Models;

use App\Http\Controllers\AbilitiesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\GroupUserController;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'linkedIn',
        'website',
        'github',
        'portfolio',
        'bio',
        'password',
        'name',
        'file_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // Lien vers la table des compétences utilisateur "abilities"
    public function abilities(): HasOne
    {
        return $this->hasOne(Abilities::class);
    }

    // Lien vers la table des rôles "roles"
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    // Lien vers la table de liens entre événements et participants "event_user"
    public function event_users(): HasMany
    {
        return $this->hasMany(EventUser::class);
    }

    //--- ci-dessous : vers GROUP la manière "belongsToMany", qui devrait simplifier la tâche et utiliser directement la table intermédiaire
    public function groups() : BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_users', 'user_id', 'group_id');
    }
    // INUTILE SI LE "belongsToMany" FONCITONNE ** Lien vers la table de liens entre groupes et participants "group_user"
    /*     public function group_users(): HasMany
    {
        return $this->hasMany(GroupUser::class);
    } */

    //--- ci-dessous : vers EVENTS la manière "belongsToMany", qui devrait simplifier la tâche et utiliser directement la table intermédiaire
    public function events() : BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_users', 'user_id', 'event_id');
    }
}
