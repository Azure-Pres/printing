<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCode extends Model
{
    use HasFactory;

    protected $fillable = ['upload_id','code_data','created_at','updated_at'];
}
