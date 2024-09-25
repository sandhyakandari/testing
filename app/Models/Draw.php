<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    use HasFactory;
    protected $table = "draw";
    protected $primaryKey = "draw_id";
    public $timestamps = true;

    protected $fillable = [
        "draw_id", "interim_draw_id", "player_num", "tournament_id", "roundOne", "roundTwo", "roundThree", "roundFour", "roundFive", "roundSix", "winner", "runnerup",
    ];
}
