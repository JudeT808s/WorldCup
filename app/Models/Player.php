<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function team()
    {
        //One particular player can only be in one team (O:M)
        return $this->belongsTo(Team::class);
    }
}