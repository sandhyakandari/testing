<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterimDraw extends Model
{
    use HasFactory;
    protected $table = "interim_draw";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $fillable = [
        "id", "tournament_id", "draw_type", "player_num", "subCategory", "gender",
    ];
}
