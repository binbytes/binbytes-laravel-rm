<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('subject');
            $table->string('description', 1000);
            $table->date('start_date');
            $table->unsignedTinyInteger('start_date_partial_hours')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedTinyInteger('end_date_partial_hours')->nullable();
            $table->boolean('is_approved')->nullable();
            $table->dateTime('approved_on')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->string('approved_note', 1000)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('approved_by')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
