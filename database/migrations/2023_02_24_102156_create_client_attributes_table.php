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
        Schema::create('client_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('attribute_id')->unsigned();
            $table->enum('applicable',['0','1'])->default('0')->comment('0-No, 1-Yes');
            $table->enum('unique',['0','1'])->default('0')->comment('0-No, 1-Yes');
            $table->timestamps();
        });

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '4',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '7',
                'applicable'    => '1',
                'unique'        => '1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '8',
                'applicable'    => '1',
                'unique'        => '1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '9',
                'applicable'    => '1',
                'unique'        => '1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '10',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '11',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '12',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '13',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '14',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '24',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '25',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '26',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '8',
                'attribute_id'  => '20',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '2',
                'attribute_id'  => '15',
                'applicable'    => '1',
                'unique'        => '1',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '2',
                'attribute_id'  => '17',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '2',
                'attribute_id'  => '18',
                'applicable'    => '1',
                'unique'        => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            )
        );

        DB::table('client_attributes')->insert(
            array(
                'user_id'       => '2',
                'attribute_id'  => '21',
                'applicable'    => '1',
                'unique'        => '0',
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
        Schema::dropIfExists('client_attributes');
    }
};
