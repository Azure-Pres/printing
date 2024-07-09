<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchPrint extends Model
{
    use HasFactory;

    protected $fillable = ['batch','created_at','updated_at'];

    public function clientUpload()
    {
        return $this->belongsTo(ClientUpload::class, 'upload_id');
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}