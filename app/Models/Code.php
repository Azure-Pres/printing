<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','batch_id','upload_id','code_data','status','serial_no','created_at','updated_at'];

    public function getClient()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }

    public function getBatch()
    {
        return $this->belongsTo(Batch::class,'batch_id','id');
    }
}
