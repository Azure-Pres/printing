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
        Schema::table('job_cards', function (Blueprint $table) {
            $table->string('machine')->nullable()->after('job_card_id');
            $table->string('print_status')->nullable()->after('machine');
            $table->bigInteger('allowed_copies')->nullable()->after('print_status');
            $table->string('first_verification_status')->nullable()->after('allowed_copies');
            $table->string('second_verification_status')->nullable()->after('first_verification_status');
            $table->string('remarks')->nullable()->after('second_verification_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_cards', function (Blueprint $table) {
            //
        });
    }
};
