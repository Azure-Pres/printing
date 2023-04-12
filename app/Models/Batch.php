<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['batch_code','client','from_serial_number','to_serial_number','status'];

    public function getClient()
    {
        return $this->belongsTo(User::class,'client','id');
    }
}
