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
        Schema::create('offline_verifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code_id')->unsigned()->nullable();
            $table->string('code_data')->nullable();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->bigInteger('scanned_by')->unsigned()->nullable();
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
        Schema::dropIfExists('offline_verifications');
    }
};
