<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUploadTemp extends Model
{
    use HasFactory;

    protected $fillable = ['qr_text','qr_id','printing_material','lot_number'];
}
