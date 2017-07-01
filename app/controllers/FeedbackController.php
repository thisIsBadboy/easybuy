<?php

class FeedbackController extends BaseController{

	function getFeedbackPage(){
		$res = DB::table('feedback')->get();
		return View::make('feedback')
				->with('title', 'Feedback | Easybuy')
				->with('res', $res);
	}

	function submitFeedback(){
		if(Request::ajax()){
			$in = Input::all();

			try{
				$thisMoment = DB::select('Select NOW() as this_time');

				$res = DB::table('feedback')->insertGetId(array('name'=>$in['name'], 'email'=>$in['email'], 'mobile'=>$in['mobile'], 'feedback_status'=>$in['feedback_status'], 'feedback_text'=>$in['feedback_text'], 'feedback_time'=>$thisMoment[0]->this_time));

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