<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wishlist_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wlid');
			$table->integer('uid');
			$table->integer('pid');
			$table->dateTime('added_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wishlist_products');
	}

}
