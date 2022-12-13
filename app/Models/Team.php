<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    //protected $fillable = ['name', 'sponsor_id', 'user_id'];
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

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class)->withTimestamps();
    }

    public function sponsor()
    {
        //One particular team can have many players (O:M)
        return $this->belongsTo(Sponsor::class);
    }
}