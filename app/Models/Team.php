<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    public function team(){
        return $this->hasMany(Player::class);
    }
    // public function team2(){
    //     return $this->belongsTo(Tournament::class);
    // }
}
