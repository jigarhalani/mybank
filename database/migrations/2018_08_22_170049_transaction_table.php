<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('transactions', function (Blueprint $table) {

		    $table->bigIncrements('id');
		    $table->integer('account_id');
		    $table->enum('type',[1,2])->comment("1 for Credit , 2 for Debit");
		    $table->enum('is_transfer',[0,1])->default(0)->comment('0 for is not an transfer,1 for transfer');
		    $table->integer('transfer_account_id')->nullable();
		    $table->enum('status',[0,1])->default(1)->comment("0 for failure, 1 for success");
		    $table->double('amount',16,2);
		    $table->double('opening_balance',16,2);
		    $table->double('closing_balance',16,2);
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
	    Schema::dropIfExists('transactions');
    }
}
