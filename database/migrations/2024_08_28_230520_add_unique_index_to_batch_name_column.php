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
    public function up()
    {
        Schema::table('paytm_batch_prints', function (Blueprint $table) {
            $table->unique('batch_name');
        });
    }

    public function down()
    {
        Schema::table('paytm_batch_prints', function (Blueprint $table) {
            $table->dropUnique(['batch_name']);
        });
    }
};
