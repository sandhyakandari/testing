<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $table = "tournaments";
    protected $primaryKey = "tournament_id";
    public $timestamps = true;

    protected $fillable = [
        "tournament_id", "tournamentCategory", "tournamentName", "academy_id", "category", "subCategory", "surface", "city", "fromDate", "toDate", "lastDate", "stay", "price", "whatsapp", "imageOne", "captionOne", "imageTwo", "captionTwo", "imageThree", "captionThree", "factsheet", "winner_id", "runnerup_id", "status", "added_at", "edited_at",
    ];
}
