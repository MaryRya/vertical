<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['date_reviews', 'text', 'id_user', 'created_at',
        'updated_at'];
    protected  $guarded = ['id_reviews'];
}