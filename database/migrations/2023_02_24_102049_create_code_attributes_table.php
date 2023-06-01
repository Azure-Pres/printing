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
            $table->timestamps();
        });

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'vpa',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'upistring',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'id',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'batch_id',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'upi_id',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'intent_string',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'sticker_id',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'qr_code_id',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'upi_qr_url',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'qr_merchandise_name',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'language',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'business_cat',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'artwork',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'date',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'qr_text',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'qr_data',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'printing_material',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'lot_no',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'material_name',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('code_attributes')->insert(
            array(
                'name'          => 'sku_id',
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