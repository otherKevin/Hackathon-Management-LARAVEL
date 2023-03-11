<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class GroupUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Lien vers la table des utilisateurs "users"
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Lien vers la table des groupes "groups"
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
