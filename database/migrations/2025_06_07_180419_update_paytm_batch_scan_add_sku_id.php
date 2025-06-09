<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('paytm_merchant_kits', function (Blueprint $table) {
            $table->string('sku_id')->nullable()->after('piece_num'); // Adjust position if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('paytm_merchant_kits', function (Blueprint $table) {
            $table->dropColumn('sku_id');
        });
    }
};
