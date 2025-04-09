<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{

    use HasFactory;
    protected $fillable = ['score', 'player_id'];
    public function player() 
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

}
