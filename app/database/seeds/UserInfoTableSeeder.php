<?php

use Carbon\Carbon;

class UserInfoTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$now = Carbon::now();

		UserModel::insert([
			['first_name'=>'Rasel', 'last_name'=>'Ahammed', 'user_name'=>'public', 'email'=>'raselcse20@gmail.com', 'password'=>Hash::make('123456'), 'contact'=>'01736803384', 'check_user'=>'no', 'created_at'=>$now, 'updated_at'=>$now],
			['first_name'=>'Rasel', 'last_name'=>'Ahammed', 'user_name'=>'admin', 'email'=>'raselcse20@ymail.com', 'password'=>Hash::make('123456'), 'contact'=>'01521337087', 'check_user'=>'yes', 'created_at'=>$now, 'updated_at'=>$now]
		]);
	}

}
