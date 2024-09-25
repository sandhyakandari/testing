<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $table = "players";
    protected $primaryKey = "player_id";
    public $timestamps = true;

    protected $fillable = [
        'player_id', 'id', 'first_name', 'middle_name', 'last_name', 'guardian_name', 'ita_number', 'dob', 'gender', 'phone', 'email', 'address_1', 'address_2', 'district', 'pin', 'state', 'country', 'photo', 'publish', 'show_on_home', 'register_at',
    ];
}
