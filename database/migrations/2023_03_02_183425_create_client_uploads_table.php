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
        Schema::create('client_uploads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('lot_number')->nullable();
            $table->string('lot_size')->nullable();
            $table->string('file_url')->nullable();
            $table->string('category')->nullable();
            $table->string('progress_id');
            $table->integer('total_rows')->default(0);
            $table->integer('processed_rows')->default(0);
            $table->integer('uploaded_rows')->default(0);
            $table->json('error_logs')->nullable();
            $table->enum('status',['0','1','2','3'])->default('0')->comment('0-Pending 1-In Progress 2-Completed 3-Failed');
            $table->enum('notified',['0','1'])->default('0')->comment('0-No 1-Yes');
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
        Schema::dropIfExists('client_uploads');
    }
};
