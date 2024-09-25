<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAcademyImage extends Model
{
    use HasFactory;
    protected $table = "upload_academy_images";
    protected $primaryKey = "upload_academy_images_id";
    public $timestamps = true;

    protected $fillable = [
        'upload_academy_images_id', 'user_id', 'academy_id', 'image', 'caption',
    ];
}
