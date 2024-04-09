<?php

use Carbon\Carbon;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name'              => 'Admin',
                'type'              => 'Admin',
                'email'             => 'admin@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'Phonepe',
                'type'              => 'Client',
                'email'             => 'phonepe@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'test user',
                'type'              => 'User',
                'email'             => 'testuser@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user1',
                'type'              => 'User',
                'email'             => 'user1@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user2',
                'type'              => 'User',
                'email'             => 'user2@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user3',
                'type'              => 'User',
                'email'             => 'user3@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user4',
                'type'              => 'User',
                'email'             => 'user4@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'id'                => '8',
                'name'              => 'Paytm',
                'type'              => 'Client',
                'email'             => 'paytm@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user5',
                'type'              => 'User',
                'email'             => 'user5@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user6',
                'type'              => 'User',
                'email'             => 'user6@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user7',
                'type'              => 'User',
                'email'             => 'user7@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'user8',
                'type'              => 'User',
                'email'             => 'user8@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            )
        );

        DB::table('users')->insert(
            array(
                'name'              => 'rupesh',
                'type'              => 'User',
                'email'             => 'rupesh@azureapp.com',
                'password'          => bcrypt('Azure#123'),
                'status'            => 'Active',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
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
        Schema::dropIfExists('users');
    }
};
