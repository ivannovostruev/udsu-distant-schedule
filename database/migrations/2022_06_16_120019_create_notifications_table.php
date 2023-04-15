<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_from')->references('id')->on('users');
            $table->foreignId('user_to')->references('id')->on('users');
            $table->text('full_message')->nullable();
            $table->text('small_message')->nullable();
            $table->string('component');
            $table->json('data');
            $table->string('url');
            $table->dateTime('time_read')->nullable();
            $table->dateTime('time_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
