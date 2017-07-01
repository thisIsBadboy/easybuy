<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('user_name');
			$table->string('message', 5000);
			$table->string('status', 10);
			$table->string('sender');
			$table->dateTime('sended_time');
			$table->dateTime('seen_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chat');
	}

}
