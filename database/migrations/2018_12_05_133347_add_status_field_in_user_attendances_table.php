<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusFieldInUserAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_attendances', function (Blueprint $table) {
            $table->string('status')
                ->nullable()
                ->after('total_times');
            $table->dropColumn('is_on_leave', 'is_absent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_attendances', function (Blueprint $table) {
            $table->boolean('is_on_leave')
                ->default(false);
            $table->boolean('is_absent')
                ->default(false);

            $table->dropColumn('status');
        });
    }
}
