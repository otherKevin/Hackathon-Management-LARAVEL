<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Récupération de l'entreprise du contact
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'admin_id', 'id');
    }
}
