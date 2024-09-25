<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $table = "ranking";
    protected $primaryKey = "rank_id";
    public $timestamps = true;

    protected $fillable = [
        "rank_id", "rank", "name", "aita_number", "dob", "state", "score", "category", "sub_category", "state_id",
    ];
}
