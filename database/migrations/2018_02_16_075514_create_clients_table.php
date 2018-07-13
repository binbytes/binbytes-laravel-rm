<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('timezone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('dob', 50)->nullable();
            //
            $table->string('mobile_no', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('skype')->nullable();
            $table->string('trello')->nullable();
            $table->string('slack')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            //
            $table->string('remarks', 3000)->nullable();
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
        Schema::dropIfExists('clients');
    }
}
