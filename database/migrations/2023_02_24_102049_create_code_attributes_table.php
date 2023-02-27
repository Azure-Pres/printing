<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->enum('has_applicable',['0','1'])->default('0')->comment('0-No, 1-Yes');
            $table->enum('has_unique',['0','1'])->default('0')->comment('0-No, 1-Yes');
            $table->enum('applicable_enabled_default',['0','1'])->default('0')->comment('0-No, 1-Yes');
            $table->enum('unique_enabled_default',['0','1'])->default('0')->comment('0-No, 1-Yes');
            $table->timestamps();
        });

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'QR_CODE',
                'applicable_enabled_default'=>'1',
                'unique_enabled_default'=>'1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'QR_CODE_URL',
                'applicable_enabled_default'=>'1',
                'unique_enabled_default'=>'1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'BATCH_Number',
                'applicable_enabled_default'=>'1',
                'unique_enabled_default'=>'1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_attributes');
    }
};