<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPlayerImage extends Model
{
    use HasFactory;
    protected $table = "upload_player_images";
    protected $primaryKey = "upload_image_id";
    public $timestamps = true;

    protected $fillable = [
        "upload_image_id", "user_id", "player_id", "image", "caption",
    ];
}
