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
        Schema::create('file_upload_temps', function (Blueprint $table) {
            $table->id();
            $table->string('qr_id', 255)->nullable();
            $table->string('qr_text', 255)->nullable();
            $table->string('printing_material', 255)->nullable();
            $table->string('lot_number', 255)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_upload_temps');
    }
};
