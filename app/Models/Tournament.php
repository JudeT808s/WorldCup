<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [];

//The relationship (O:M) with team and tournmament
public function tournament(){
    return $this->belongsTo(Team::class);
}

public function user(){
    return $this->belongsTo(User::class);
}
}