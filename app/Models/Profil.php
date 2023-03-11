<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Test relation Adrien entre User et Profil pour afficher les donées d'un profil
    public function User()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
