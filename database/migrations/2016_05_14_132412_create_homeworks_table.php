<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->string('homeworkName');
            $table->string('homeworkAddress');
            $table->date('expiredTime');
            $table->integer('sequence');
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
//'2', '1', '对对对', '3456', '2016-01-01 00:00:00', '1', '2016-01-01 00:00:00', '2016-01-01 00:00:00'
//'12', '1', '对对对', '3456', '2016-01-01 00:00:00', '2', '2016-01-01 00:00:00', '2016-01-01 00:00:00'
//'13', '1', '对对对', '3456', '2016-01-01 00:00:00', '2', '2016-01-01 00:00:00', '2016-01-01 00:00:00'
//'19', '2', '1', '3456', '2016-01-01 00:00:00', '34', '2016-01-01 00:00:00', '2016-05-14 13:22:35'
//'20', '2', '333', '3456', '2016-01-01 00:00:00', '4', '2016-01-01 00:00:00', '2016-01-01 00:00:00'
