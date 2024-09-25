<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
    protected $table = "rounds";
    protected $fillable = [
        "draw_id", "player_id", "roundOne", "roundTwo", "roundThree", "roundFour", "roundFive", "roundSix",
    ];
}
