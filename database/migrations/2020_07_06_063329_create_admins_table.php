<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
          
            $table->id();
         
            
            //$table->string('email');
           // $table->string('tel');
            $table->string('userid')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('passdecode')->default('none');
            $table->string('platform')->index('platform');
            $table->string('lat')->default('none')->index('lat');
            $table->string('lng')->default('none')->index('lng');
            $table->string('dynamic_address')->default("none");
          
          //pharmacy
            $table->string('name');
            $table->string('tel')->default("none");
            $table->string('email')->default("none");
            $table->string('postal_address')->default("none");
            $table->string('phys_address')->default('none')->index('phys_address');
            $table->string('y_number')->default("none");
       //pharmacist
            $table->string('fname')->default("none");
            $table->string('lname')->default("none");
            $table->string('alternative_no')->default("none");
            $table->string('p_number')->default("none");

            $table->longtext('audio')->nullable();
            $table->string('audio_setting')->default('{"muted":false,"audio_volume":"100"}');
            $table->timestamp('creation_date')->useCurrent();
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
        Schema::dropIfExists('admins');
    }
}
