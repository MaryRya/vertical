<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['id', 'id_user', 'sum', 'suc', 'id_record', 'date'];
    protected  $guarded = ['id'];
    public $timestamps = false;
}
