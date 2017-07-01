<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as'=>'Home', function(){
	$latest = ProductModel::where('latest','=',1)->take(50)->get();
	$specialOffer = ProductModel::where('off', '>', 0)->take(50)->get();
	$popular = ProductModel::where('sell_qty','>',0)->orderBy('sell_qty', 'desc')->take(50)->get();
	return View::make('index')
			->with('title', 'Home | Easybuy')
			->with('latest', $latest)
			->with('special', $specialOffer)
			->with('popular', $popular);
}]);

/********************User********************/
Route::get('signup', 'UserController@getSignUpPage');
Route::post('create_new_user', 'UserController@createNewUser');
Route::post('create_user_account', array('as'=>'Create User Account', 'uses'=>'UserController@createUserAccount'));
Route::get('login', 'UserController@getLoginPage');
Route::post('login_user', 'UserController@loginUser');
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@logOut'));
Route::get('profile', array('as'=>'Profile', 'uses'=>'UserController@getProfilePage'));

Route::post('forgot_password', 'UserController@forgotPassword');
Route::post('changeName', 'UserController@changeName');
Route::post('changeUsername', 'UserController@changeUsername');
Route::post('changeEmail', 'UserController@changeEmail');
Route::post('changePassword', 'UserController@changePassword');
Route::post('changePhone', 'UserController@changePhone');
/********************************************/

/***************************Admin*********************/

Route::get('admin_panel', array('as'=>'Admin Panel', 'uses'=>'AdminController@getAdminPanel'));
Route::get('get_history', array('as'=>'History', 'uses'=>'AdminController@getHistory'));

/*****************************************************/

/*******************Product********************/
Route::get('product_page', array('as'=>'Product Page', 'uses'=>'ProductController@getProductPage'));

Route::get('prd_page_with_specific_cat', array('as'=>'Product Page With Specific Category', 'uses'=>'ProductController@getCategorySpecificPage'));

Route::get('add_new_product','ProductController@getAddNewProductPage');
Route::post('new_product', 'ProductController@newProduct');

Route::get('update_product-{id}', 'ProductController@getUpdateProductPage');
Route::post('updated_product{id}', 'ProductController@updatedProduct');

Route::get('delete_product{id}', 'ProductController@deleteProduct');
Route::get('show_datail', 'ProductController@showDetail');
Route::post('addCategory', 'ProductController@addCategory');
Route::post('add_sub_category', 'ProductController@addSubCategory');
Route::post('get_sub_category', 'ProductController@getSubCategory');
Route::post('search_product', 'ProductController@searchProduct');
/********************************************/

/*******************Cart*********************/
Route::get('cart', 'CartController@getCartPage');
Route::post('add_to_cart', 'CartController@addToCart');
Route::post('add_to_cart_by_plus', 'CartController@addToCartByPlus');
Route::post('add_to_cart_by_hand', 'CartController@addToCartByHand');
Route::post('remove_from_cart_by_cross', 'CartController@removeFromCartByCross');
Route::post('remove_from_cart', 'CartController@removeFromCart');
Route::post('clear_cart', 'CartController@clearCart');
Route::post('order_item', 'CartController@orderItem');
Route::get('my_order', array('as'=>'Order List', 'uses'=>'CartController@myOrder'));
Route::post('delete_order', 'CartController@deleteOrder');
Route::get('order_details-{id}', 'CartController@orderDetails');
/********************************************/

/*******************Chat********************/
Route::get('golpo_with_admin', 'ChatController@getUserChatPage');
Route::post('send_to_admin', 'ChatController@sendToAdmin');
Route::post('get_message', 'ChatController@getMessage');
Route::post('count_admin_message', 'ChatController@countAdminMessage');
Route::get('reply{id}', 'ChatController@replyFromAdmin');
/*******************************************/

/***************Payment*****************/
Route::get('payment{id}', 'PaymentController@getbKashPage');
Route::post('change_payment_status', 'PaymentController@changePaymentStatus');
/***************************************/

Route::get('feedback', array('as'=>'Feedback', 'uses'=>'FeedbackController@getFeedbackPage'));
Route::post('submit_feedback', 'FeedbackController@submitFeedback');

Route::post('submit_your_review', 'ReviewController@submitYourReview');
Route::get('policy', function(){
	return View::make('policy')
		->with('title', "Policies | Easybuy");
});

Route::get('reviews{pid}', function($pid){
	$review = DB::table('product_reviews')->where(array('pid'=>$pid))->get();
	return View::make('reviews')
		->with('title', 'Reviews')
		->with('reviewCnt', count($review))
		->with('review', $review);
});

Route::get('wishlist', array('as'=>'Wishlist', 'uses'=>'WishlistController@getWishlist'));
Route::get('add_to_wishlist_{pid}', 'WishlistController@addToWishlist');
Route::get('remove_from_wishlist_{pid}', 'WishlistController@removeFromWishlist');

Route::get('contact_us', function(){
	return View::make('contact_us')
		->with('title', 'Contact Us | Easybuy');
});

Route::post('submit_contact_message', function(){
	$in = Input::all();

	$thisMoment = DB::select('Select NOW() as this_time');
	$id = DB::table('contact_us')->insertGetId(array('name'=>$in['name'], 'email'=>$in['email'], 'subject'=>$in['subject'], 'message'=>$in['message'], 'added_time'=>$thisMoment[0]->this_time));

	if($id){

	}else{

	}

	return Redirect::to('contact_us')
		->with('title', 'Contact Us | Easybuy');
});

Route::get('contact_messages', function(){
	$contactUsMessage = DB::table('contact_us')->get();

	return View::make('contact_message')
		->with('msgCnt', count($contactUsMessage))
		->with('msg', $contactUsMessage)->withTitle('Contact Message | Easybuy');
});