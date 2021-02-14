<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name')->default("none");
          
            $table->string('email')->default("none");
            $table->string('country_code')->index('country_code')->default("none");
            $table->string('country')->index('country')->default("none");
            $table->string('table_uid')->index('table_uid')->default("none");

            $table->string('tel')->default("none");
            $table->string('otp')->default("none")->index('otp');
            $table->string('userid')->unique();
            $table->integer('notification_counter')->default(0);//for tracking notification on payment 

            $table->string('password');
            $table->string('passdecode')->default('none');
            $table->string('platform')->default("Standard")->index('platform');
            $table->string('lat')->default('none')->index('lat');
            $table->string('lng')->default('none')->index('lng');
            $table->string('dynamic_address')->default("none");
            $table->string('phys_address')->default('none')->index('phys_address');
           
            $table->string('dob')->default('0000-00-00');
            $table->string('gender')->default('none');
            $table->string('id_number')->default('none');
            $table->string('marital_status')->default('none');
            $table->string('title')->default('none');
            $table->longtext('audio')->nullable();
            $table->string('audio_setting')->default('{"muted":false,"audio_volume":"100"}');
            
        
           // $table->string('status')->index('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
