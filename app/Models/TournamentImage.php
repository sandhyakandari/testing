<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentImage extends Model
{
    use HasFactory;
    protected $table = "tournament_images";
    protected $primaryKey = "tournament_image_id";
    public $timestamps = true;

    protected $fillable = [
        "tournament_image_id", "tournament_id", "image", "added_at",
    ];
}
