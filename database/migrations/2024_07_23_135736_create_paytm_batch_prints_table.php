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
        Schema::create('paytm_batch_prints', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name')->nullable()->index();
            $table->string('printing_material')->nullable();
            $table->boolean('verified')->default(false);

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
        Schema::dropIfExists('paytm_batch_prints');
    }
};
