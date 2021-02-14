<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePartitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_partitions', function (Blueprint $table) {
            $table->id();
            $table->string('table_uid')->index('table_uid');//table_id
            $table->string('country_code')->index('country_code');//country code 
            $table->string('country')->index('country')->default("none");
            $table->integer('total')->index('total');//number of people are assigned on this table
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
        Schema::dropIfExists('table_partitions');
    }
}
