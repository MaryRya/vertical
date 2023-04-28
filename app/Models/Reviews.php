<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['date_reviews', 'text', 'id_users'];
    protected  $guarded = ['id_reviews'];
    public $timestamps = false;
}
