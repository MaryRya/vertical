<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dance_lesson extends Model
{
    use HasFactory;
    protected $table = 'dance_lesson';
    protected $fillable = ['lesson_name', 'lesson_description', 'lesson_description_all',
        'things',
        'lesson_price',
        'lesson_description',
        'img_lesson'];
    protected  $guarded = ['id_lesson'];
    public $timestamps = false;
}
