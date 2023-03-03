<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAttribute extends Model
{
    use HasFactory;

    public function getCodeAttribute()
    {
        return $this->belongsTo(CodeAttribute::class,'attribute_id','id');
    }
}
