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
        Schema::table('client_uploads', function (Blueprint $table) {
            $table->string('printing_material')->nullable()->after('lot_size');
            $table->string('production_status')->nullable()->default('Pending')->after('status');
            $table->timestamp('ready_at')->nullable()->after('production_status');
            $table->timestamp('dispatched_at')->nullable()->after('ready_at');
            $table->text('dispatch_data')->nullable()->after('dispatched_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_uploads', function (Blueprint $table) {
            $table->dropColumn('printing_material');
            $table->dropColumn('production_status');
            $table->dropColumn('ready_at');
            $table->dropColumn('dispatched_at');
            $table->dropColumn('dispatch_data');
        });
    }
};
