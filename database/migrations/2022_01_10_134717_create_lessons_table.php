<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->string('name', 1024);

            $table->date('date');
            //$table->smallInteger('periodicity');
            //$table->date('expiration_date')->nullable();

            $table->foreignId('teacher_id')->constrained('teachers');

            $table->smallInteger('education_level');
            $table->smallInteger('type');
            $table->smallInteger('system_type');
            $table->smallInteger('link_type');
            $table->smallInteger('location');

            $table->text('link')->nullable();
            $table->text('commentary')->nullable();

            $table->boolean('should_record')->default(0);
            $table->string('special_requirements')->nullable();

            $table->foreignId('timeslot_id')->constrained('timeslots');
            $table->foreignId('color_id')->nullable()->constrained('colors');
            $table->foreignId('room_id')->nullable()->constrained('rooms');

            $table->text('admin_feedback')->nullable();
            $table->text('connect_info')->nullable();

            $table->smallInteger('status');

            $table->foreignId('created_by')
                ->references('id')
                ->on('users');

            $table->foreignId('updated_by')
                ->nullable()
                ->references('id')
                ->on('users');

            $table->timestamps();

            // indexes
            //$table->index('periodicity');
            $table->index('type');
            $table->index('system_type');
            $table->index('status');
            $table->index('date');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
