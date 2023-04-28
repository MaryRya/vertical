<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dance_direction extends Model
{
    use HasFactory;
    protected $table = 'dance_direction';
    protected $fillable = ['directions_name'];
    protected  $guarded = ['id_direction'];
}
