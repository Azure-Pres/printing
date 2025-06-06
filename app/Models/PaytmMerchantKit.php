<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaytmMerchantKit extends Model
{
    protected $table = 'paytm_merchant_kits';

    protected $fillable = [
        'sticker_id',
        'qr_code_id',
        'upi_qr_url',
        'batch_id',
        's_no',
        'lot_no',
        'lot_s_no',
        'piece_num',
        'type',
    ];
}
