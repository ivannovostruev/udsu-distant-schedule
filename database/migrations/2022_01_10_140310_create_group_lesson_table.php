<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_lesson', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('group_id')->constrained('groups');
//            $table->foreignId('lesson_id')->constrained('lessons');
            $table->foreignId('group_id')->constrained();
            $table->foreignId('lesson_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_lesson');
    }
}
