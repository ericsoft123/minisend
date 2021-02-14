<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_emails', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->index('uid');//unique id of email
            
            $table->string('sender_name')->index('sender_name')->default('none');
            $table->string('sender_email')->index('sender_email')->default('none');
            $table->string('recipient_name')->index('recipient_name')->default('none');
            $table->string('recipient_email')->index('recipient_email')->default('none');
            $table->string('subject')->index('subject')->default('none');
            $table->longtext('email_content')->nullable();
            $table->string('att_url')->default('none');
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
        Schema::dropIfExists('sent_emails');
    }
}
