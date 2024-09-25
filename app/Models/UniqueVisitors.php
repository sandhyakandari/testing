<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueVisitors extends Model
{
    use HasFactory;
    protected $table='visitorsip';
    protected $fillable=['ip_address'];
}
