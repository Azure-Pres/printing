<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaytmBatchPrint extends Model
{
    use HasFactory;

    protected $fillable = ['batch_name','printing_material','verified','created_at','updated_at'];
}