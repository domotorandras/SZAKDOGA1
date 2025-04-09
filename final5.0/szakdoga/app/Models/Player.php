<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password'];

    public function district()
    {
        return $this->hasMany(District::class, 'player_id');
    }

    public function subDistrict()
    {
        return $this->hasMany(SubDistrict::class, 'player_id');
    }

    public function guessr()
    {
        return $this->hasMany(Guessr::class, 'player_id');
    }

}
