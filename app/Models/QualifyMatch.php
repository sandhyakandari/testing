<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualifyMatch extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
            'interim_draw_id','qualify_round_id','player1_id','player2_id','statu','score'    
    ];
}
