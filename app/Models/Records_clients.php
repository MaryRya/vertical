<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Records_clients extends Model
{
    use HasFactory;
    protected $table = 'records_clients';
    protected $fillable = [' id_schedule', 'id_user','attendance', 'created_at', 'updated_at'];
    protected  $guarded = ['id_record'];
}
