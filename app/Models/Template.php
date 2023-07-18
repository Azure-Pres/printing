<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['name','client_id','status','created_by','data','created_at','updated_at'];

    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
}
