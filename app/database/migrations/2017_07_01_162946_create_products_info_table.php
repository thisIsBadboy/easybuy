<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category', 100);
			$table->string('sub_category', 100);
			$table->string('product_name', 100);
			$table->string('description', 500);
			$table->string('features', 500);
			$table->integer('no_of_item');
			$table->double('price', 18, 5);
			$table->double('real_price', 18, 5);
			$table->integer('off');
			$table->integer('latest');
			$table->string('product_image', 100);
			$table->integer('sell_qty');
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
		Schema::drop('products_info');
	}

}
