<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawPlayerTournament extends Model
{
    use HasFactory;

    protected $table = "draw_players_tournament";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
        "id", "player_id", "draw_id", "seed", "by",
    ];
}
