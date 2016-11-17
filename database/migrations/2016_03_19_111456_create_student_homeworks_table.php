<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('student_homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('homework_id');
            $table->boolean('isSubmit');
            $table->string('homeworkSubAddress')->nullable();
            $table->string('homeworkName')->nullable();
            $table->double('score')->nullable();
            $table->longText('comment')->nullable();
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
        //
    }
}
