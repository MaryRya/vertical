<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $fillable = ['date_lesson', 'id_time_lesson', 'id_lesson', 'id_hall', 'id_user', 'count_places', 'created_at',
        'updated_at' ];
    protected  $guarded = [' id_schedule'];

}
