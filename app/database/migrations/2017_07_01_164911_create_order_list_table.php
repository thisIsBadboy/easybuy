<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_list', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('ref_no');
			$table->integer('no_of_item');
			$table->double('total_price', 18, 5);
			$table->string('ordered_items', 10000);
			$table->string('payment_method');
			$table->string('mobile');
			$table->string('alt_mobile');
			$table->string('address_line_1', 1000);
			$table->string('address_line_2', 1000);
			$table->string('upazilla');
			$table->string('district');
			$table->integer('payment_status');
			$table->dateTime('order_time');
			$table->dateTime('payment_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_list');
	}

}
