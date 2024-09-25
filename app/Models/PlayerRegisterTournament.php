<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerRegisterTournament extends Model
{
    use HasFactory;

    protected $table = "player_register_tournament";
    protected $primaryKey = "register_id";
    public $timestamps = true;

    protected $fillable = [
        "register_id", "player_id", "tournament_id", "category", "sub_category", "status", "register_at",
    ];
}
