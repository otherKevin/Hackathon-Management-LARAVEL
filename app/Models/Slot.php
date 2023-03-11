<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Slot extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    //--- Liens avec la table groups, via running_orders
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'running_orders', 'slot_it', 'group_id');
    }
}
