<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    // protected $fillable = ['name']
    protected $guarded = [];

    public function team()
    {
        //One particular team can have many players (O:M)
        return $this->hasMany(Player::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sponsors()
    {
        //One particular team can have many players (O:M)
        return $this->belongsToMany(Sponsor::class)->withTimestamps();
    }
}