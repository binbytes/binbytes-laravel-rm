<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedSmallInteger('sequence_number')->default(0);
            $table->dateTime('date');
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->decimal('credit_amount')->nullable();
            $table->decimal('debit_amount')->nullable();
            $table->decimal('closing_balance');
            $table->string('type')->nullable();
            $table->string('note', 3000)->nullable();
            $table->string('invoice')->nullable();
            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')->on('accounts')
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
        Schema::dropIfExists('transactions');
    }
}
