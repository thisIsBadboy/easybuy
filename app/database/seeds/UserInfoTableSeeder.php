<?php

class UserInfoTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		UserModel::insert([
			['first_name'=>'Rasel', 'last_name'=>'Ahammed', 'user_name'=>'public', 'email'=>'raselcse20@gmail.com', 'password'=>Hash::make('123456'), 'contact'=>'01736803384', 'check_user'=>'no'],
			['first_name'=>'Rasel', 'last_name'=>'Ahammed', 'user_name'=>'admin', 'email'=>'raselcse20@ymail.com', 'password'=>Hash::make('123456'), 'contact'=>'01521337087', 'check_user'=>'yes']
		]);
	}

}
