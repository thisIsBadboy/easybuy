<?php

class ReviewController extends BaseController{

	public function submitYourReview(){
		if(Request::ajax()){
			$in = Input::all();

			try{
				$userId = Auth::user()->id;
				$thisMoment = DB::select('Select NOW() as this_time');

				$res = DB::table('product_reviews')->insertGetId(array('pid'=>$in['pid'], 'uid'=>$userId, 'name'=>$in['name'], 'email'=>$in['email'], 'review_text'=>$in['review_text'], 'rating'=>$in['rating'], 'review_time'=>$thisMoment[0]->this_time));

				if($res){
					return 'success';
				}else{
					return 'fail';
				}
			}catch(Exception $ex){
				return 'fail';
			}
		}
	}
}