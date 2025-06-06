<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaytmMerchantKitsTable extends Migration
{
    public function up(): void
    {
        Schema::create('paytm_merchant_kits', function (Blueprint $table) {
            $table->id();
            $table->string('sticker_id')->index();
            $table->string('qr_code_id')->unique();        // searchable + unique
            $table->string('upi_qr_url')->unique();        // searchable + unique
            $table->string('batch_id')->index();
            $table->integer('s_no');
            $table->integer('lot_no');
            $table->integer('lot_s_no');
            $table->string('piece_num');
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paytm_merchant_kits');
    }
}
