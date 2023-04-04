<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientUpload extends Model
{
    use HasFactory;

    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
}
