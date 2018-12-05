<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdAndParentTypeFieldInAttendanceSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_sessions', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')
                ->nullable()
                ->after('total_times');

            $table->string('parent_type')
                ->nullable()
                ->after('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_sessions', function (Blueprint $table) {
            $table->dropColumn('parent_id', 'parent_type');
        });
    }
}
