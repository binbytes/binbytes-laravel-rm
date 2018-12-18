<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceSessionUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_session_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('session_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->string('note')->nullable();
            $table->timestamps();

//            $table->foreign('session_id')
//                ->references('id')
//                ->on('attendance_sessions')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_session_updates');
    }
}
