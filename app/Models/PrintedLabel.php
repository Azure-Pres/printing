<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintedLabel extends Model
{
    protected $table = 'printed_labels';

    protected $fillable = [
        'upi_qr_url',
    ];
}
