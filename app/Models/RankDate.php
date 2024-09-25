<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankDate extends Model
{
    use HasFactory;
    protected $table = "rank_date";
    protected $primaryKey = "rank_date_id";
    public $timestamps = true;

    protected $fillable = ["rank_date_id", "date", "added_at"];
}
