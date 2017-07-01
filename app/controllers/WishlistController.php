<?php

class WishlistController extends BaseController{
	public function getWishlist(){
		$res = DB::select("Select * from products_info where id in(Select distinct(pid) from wishlist_products where uid = ".Auth::user()->id.")");

		//var_dump($res);
		return View::make('wishlist')
		->with('title', 'Wishlist | Easybuy')
		->with('wishlist', $res);
	}

	public function addToWishlist($pid)	{

		try{
				$wish_prd = DB::table('wishlist_products')->select('id')->where(array('uid'=>Auth::user()->id, 'pid'=>$pid))->get();

				$total = count($wish_prd);

				if($total == 0){
					$thisMoment = DB::select('Select NOW() as this_time');

					$id = DB::table('wishlist_products')->insertGetId(array('uid'=>Auth::user()->id, 'pid'=>$pid, 'added_time'=>$thisMoment[0]->this_time));
				}

				$res = DB::select("Select * from products_info where id in(Select pid from wishlist_products where uid = ".Auth::user()->id.")");

				//var_dump($res);
				return Redirect::to('wishlist')
						->with('title', 'Wishlist | Easybuy')
						->with('wishlist', $res);
			}catch(Exception $ex){
				return 'Something wrong!';
			}
	}

	public function removeFromWishlist($pid){
		try{
			$sc = DB::table('wishlist_products')->where(array('uid'=>Auth::user()->id, 'pid'=>$pid))->delete();

			if($sc){
				$res = DB::select("Select * from products_info where id in(Select pid from wishlist_products where uid = ".Auth::user()->id.")");

				return Redirect::to('wishlist')
					->with('title', 'Wishlist | Easybuy')
						->with('wishlist', $res);
			}
		}catch(Exception $ex){

		}
	}
}