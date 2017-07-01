<?php

class ChatController extends BaseController {

	public function getUserChatPage(){
		return View::make('user_chat_page')
				->with('title', 'Chat | Easybuy');
	}

	public function sendToAdmin(){
		$in = Input::all();

		try{
			$thisMoment = DB::select('Select NOW() as this_time');

			$obj = new ChatModel;
			$obj->user_id = $in['userId'];
			$obj->user_name = $in['userName'];
			$obj->message = $in['message'];
			$obj->status = $in['status'];
			$obj->sender = $in['sender'];
			$obj->sended_time = $thisMoment[0]->this_time;
			$obj->save();

			return 1;
		}catch(Exception $e){
			return 0;
		}
	}

	public function getMessage(){
		$in = Input::all();
		$thisMoment = DB::select('Select NOW() as this_time');
		ChatModel::where(array('user_id'=>$in['userId'], 'sender'=>$in['sender'], 'status'=>'not seen'))->update(array('status'=>'seen', 'seen_time'=>$thisMoment[0]->this_time));
		$data = ChatModel::where('user_id', '=', $in['userId'])->get();
		return json_encode($data); 		
	}

	public function countAdminMessage(){
		$data = ChatModel::select('user_id', 'user_name', DB::raw('count(*) as total'))
				->where('status', '=', 'not seen')
				->groupBy('user_id')
				->get();
		return json_encode($data);
	}

	public function replyFromAdmin($id){
		$user = UserModel::select('first_name')->where('id', '=', $id)->get();
		$data = json_encode($user);
		return View::make('admin_chat_page')
				->with('title', 'Chat | Easybuy')
				->with('userId', $id)
				->with('userName', $user[0]['first_name']);
	}
}