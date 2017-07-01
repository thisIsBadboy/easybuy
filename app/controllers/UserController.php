<?php

class UserController extends BaseController{

	public function getLoginPage(){
		return View::make('login')
				->with('title', 'Login or Registration | Easybuy')
				->with('hasError', 'No');
	}

	public function getSignUpPage(){
		return View::make('signup');
	}

	public function createNewUser(){
		$in = Input::all();
		$v = Validator::make($in, UserModel::$rules);

		if($v->fails()){
			return Redirect::to('login')->withErrors($v);
		}

		else{
			$userObj = new UserModel;
			$userObj->first_name = $in['first_name'];
			$userObj->last_name = $in['last_name'];
			$userObj->user_name = $in['user_name'];
			$userObj->password = Hash::make($in['password']);
			$userObj->email = $in['email'];
			$userObj->contact = $in['contact'];
			$userObj->check_user = 'no';

			$thisMoment = DB::select('Select NOW() as this_time');
			$userObj->created_time = $thisMoment[0]->this_time;
			
			$userObj->save();

			return Redirect::to('/');
		}
	}

	public function loginUser(){
		//if(Request::ajax())

			$in = Input::all();

			if(isset($in['keep_me_sign_in']))
				$flag = true;

			else
				$flag = false;

			$userdata = array('user_name'=>$in['user_name'], 'password'=>$in['password']);

			if(Auth::attempt($userdata, $flag)){
				$latest = ProductModel::where('latest','=',1)->get();
				$specialOffer = ProductModel::where('off', '>', 0)->get();
				$popular = ProductModel::where('sell_qty','>',0)->orderBy('sell_qty', 'desc')->get();

				return Redirect::to('/')
						->with('title', 'Home | Easybuy')
						->with('latest', $latest)
						->with('special', $specialOffer)
						->with('popular', $popular);
			}

			else
				return View::make('login')
					->with('title', 'Login or Registration | Easybuy')
					->with('hasError' , 'Yes');
	}

	public function getProfilePage(){
		return View::make('profile')
				->with('title', 'Profile | Easybuy');
	}

	public function logOut(){
		Auth::logout();
		return Redirect::to('login');
	}

	public function forgotPassword(){
		if(Request::ajax()){
			$in = Input::all();

			$result = UserModel::select('email')->where(array('email'=>$in['email']))->get();
			
			foreach($result as $res){
				$to = $in['email'];
				$subject = "Test Mail";
				$message = "Current Password";
				mail($to, $subject, $message);
				return 'true';
			}

			return 'false';
		}
	}

	public function changeName(){
		if(Request::ajax()){
			$in = Input::all();

			try{
				$thisMoment = DB::select('Select NOW() as this_time');
				$result = UserModel::where('id', '=' , $in['id'])
							->update(array('first_name'=>$in['first_name'], 'last_name'=>$in['last_name'], 'updated_time'=>$thisMoment[0]->this_time));
				return 1;
			}catch(Exception $e){
				return 0;
			}	
		}
	}

	public function changeUsername(){
		if(Request::ajax()){
			$in = Input::all();

			try{
				$thisMoment = DB::select('Select NOW() as this_time');
				$result = UserModel::where('id', '=' , $in['id'])
							->update(array('user_name'=>$in['user_name'], 'updated_time'=>$thisMoment[0]->this_time));
				return 1;
			}catch(Exception $e){
				return 0;
			}	
		}
	}

	public function changeEmail(){
		if(Request::ajax()){
			$in = Input::all();

			try{
				$thisMoment = DB::select('Select NOW() as this_time');
				$result = UserModel::where('id', '=' , $in['id'])
							->update(array('email'=>$in['email'], 'updated_time'=>$thisMoment[0]->this_time));
				return 1;
			}catch(Exception $e){
				return 0;
			}	
		}
	}

	public function changePassword(){
		if(Request::ajax()){
			$in = Input::all();

			if(Hash::check($in['old_password'], Auth::user()->password)){

				try{
					$thisMoment = DB::select('Select NOW() as this_time');
					$result = UserModel::where('id', '=' , $in['id'])
								->update(array('password'=>Hash::make($in['new_password']), 'updated_time'=>$thisMoment[0]->this_time));
					return 1;
				}catch(Exception $e){
					return 0;
				}
			}

			else
				return 'false';
		}
	}

	public function changePhone(){
		if(Request::ajax()){
			$in = Input::all();

			try{
				$thisMoment = DB::select('Select NOW() as this_time');
				$result = UserModel::where('id', '=' , $in['id'])
							->update(array('contact'=>$in['contact'], 'updated_time'=>$thisMoment[0]->this_time));
				return 1;
			}catch(Exception $e){
				return 0;
			}	
		}
	}
}