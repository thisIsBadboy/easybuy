<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_reviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pid');
			$table->integer('uid');
			$table->string('name');
			$table->string('email');
			$table->string('review_text', 1500);
			$table->integer('rating');
			$table->dateTime('review_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_reviews');
	}

}
