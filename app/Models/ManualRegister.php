<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualRegister extends Model
{
    use HasFactory;
    protected $table = "manual_registration";
    protected $primaryKey = "manual_register_id";
    public $timestamps = true;
    protected $fillable = [
        "manual_register_id", "academy_id", "tournament_id", "name", "gender", "dob", "aita_number", "rank", "state", "register_at", "sub_category", "category",
    ];
}
