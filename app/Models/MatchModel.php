<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;
    protected $table = "matches";
    protected $fillable = [
        "draw_id", "round_id", "player1_id", "player2_id", "status", "score",
    ];
}
