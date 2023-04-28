<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_lesson extends Model
{
    use HasFactory;
    protected $table = 'time_lesson';
    protected $fillable = ['start_time', 'end_time'];
    protected  $guarded = ['id_time_lesson'];
}
