<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineHistory extends Model
{
    use HasFactory;
    
    protected $fillable = ['history','created_at','updated_at'];
}
