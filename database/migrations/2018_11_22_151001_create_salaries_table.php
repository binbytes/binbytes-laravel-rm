<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('base_salary');
            $table->integer('paid_amount');
            $table->date('paid_for');
            $table->integer('pf')->default(0);
            $table->integer('tds')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('penalty')->default(0);
            $table->text('payment_method')->nullable();
            $table->text('paid_note', 3000)->nullable();
            $table->text('general_note', 3000)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
