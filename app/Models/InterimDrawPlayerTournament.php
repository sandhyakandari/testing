<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterimDrawPlayerTournament extends Model
{
    use HasFactory;
    protected $table = "interim_draw_players_tournament";

    protected $fillable = [
        "player_id", "player_name", "dob", "aita_number", "rank", "interim_draw_id",
    ];
}
