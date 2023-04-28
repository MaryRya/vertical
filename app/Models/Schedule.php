<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $fillable = ['date_lesson', 'id_time_lesson', 'id_lesson', 'id_hall', 'id_users', 'count_place' ];
    protected  $guarded = [' id_schedule'];
    public $timestamps = false;
}
