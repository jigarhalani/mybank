<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

	    Schema::create('accounts', function (Blueprint $table) {

		    $table->increments('id');
		    $table->integer('user_id');
		    $table->enum('type',[1,2])->default(1)->comment('1 for saving , 2 for current');
		    $table->double('balance',16,2)->default(0);
		    $table->enum('is_active',[0,1])->default(1)->comment('0 means inactive and 1 means account is active');
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
	        Schema::dropIfExists('accounts');
    }
}
