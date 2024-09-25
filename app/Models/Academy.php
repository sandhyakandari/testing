<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;
    protected $table = "academies";
    protected $primaryKey = "academy_id";
    public $timestamps = true;

    protected $fillable = [
        "academy_id", "id", "aita_number", "name", "owner_name", "phone", "email", "stay", "no_of_court", "hard", "clay", "grass", "address", "city", "pin", "state", "photo", "web", "geo_location", "aboutAcademy", "aboutDescription", "our_team", "training_programmes", "our_achievements", "publish", "show_on_home", "register_at",
    ];
}
