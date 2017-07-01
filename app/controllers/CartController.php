<?php

class CartController extends BaseController {

	public function addToCart(){
		if(Request::ajax()){
			$data = Input::all();
			$prdId = $data['id'];

			$prdDetails = ProductModel::find($prdId);
			$id = (string) $prdDetails['id'];
			$name = $prdDetails['product_name'];
			$price = $prdDetails['price'];

			Cart::add($id, $name, 1, $price);

			return Cart::count();
		}
	}

	public function getCartPage(){
		$cat = array('Cloth', 'Electronics', 'Shoe', 'Book', 'Cosmatics', 'Others');
		return View::make('cart')
			->with('title', 'Cart | Easybuy')
			->with('cat', $cat);
	}

	public function addToCartByPlus(){
		if(Request::ajax()){
			$in = Input::all();
			$row = Cart::get($in['rowid']);
			
			$qty = $row->qty;
			Cart::update($in['rowid'], array('qty' => $qty+1));
			$cartData = array('qty'=>$row->qty, 'subtotal'=>$row->subtotal, 'count'=>Cart::count(), 'totalPrice'=>Cart::total());

			if($row->qty == 0){
				Cart::remove($in['rowid']);
			}

			return $cartData;
		}
	}

	public function addToCartByHand(){
		if(Request::ajax()){
			$in = Input::all();
			$row = Cart::get($in['rowid']);
			
			$qty = $row->qty;
			Cart::update($in['rowid'], array('qty' => $in['item']));
			$cartData = array('qty'=>$row->qty, 'subtotal'=>$row->subtotal, 'count'=>Cart::count(), 'totalPrice'=>Cart::total());

			if($row->qty == 0){
				Cart::remove($in['rowid']);
			}

			return $cartData;
		}
	}

	public function removeFromCartByCross(){
		if(Request::ajax()){
			$in = Input::all();
			$row = Cart::get($in['rowid']);
			Cart::update($in['rowid'], array('qty'=>0));

			$cartData = array('qty'=>$row->qty, 'subtotal'=>$row->subtotal, 'count'=>Cart::count(), 'totalPrice'=>Cart::total());

			if($row->qty == 0){
				Cart::remove($in['rowid']);
			}

			return $cartData;
		}
	}

	public function removeFromCart(){
		if(Request::ajax()){
			$in = Input::all();
			$row = Cart::get($in['rowid']);
			
			$qty = $row->qty;
			Cart::update($in['rowid'], array('qty' => $qty-1));
			$cartData = array('qty'=>$row->qty, 'subtotal'=>$row->subtotal, 'count'=>Cart::count(), 'totalPrice'=>Cart::total());

			if($row->qty == 0){
				Cart::remove($in['rowid']);
			}

			return $cartData;
		}
	}

	public function clearCart(){
		if(Request::ajax()){
			try{
				Cart::destroy();
				return 1;
			}catch(Exception $e){
				return 0;
			}
		}
	}

	public function orderItem(){
		if(Request::ajax()){
			$in = Input::all();
			if(Auth::check()){
				if(Cart::count() != 0){
					$obj = new OrderModel;
					$obj->user_id = Auth::user()->id;
					$obj->ref_no = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
					$obj->no_of_item = Cart::count();
					$obj->total_price = Cart::total();
					$obj->ordered_items = Cart::content();
					$obj->payment_method = $in['payment_method'];
					$obj->mobile = $in['mobile'];
					$obj->address_line_1 = $in['address_line_1'];
					$obj->upazilla = $in['upazilla'];
					$obj->district = $in['district'];

					$thisMoment = DB::select('Select NOW() as this_time');
					$obj->order_time = $thisMoment[0]->this_time;

					$obj->save();
					Cart::destroy();
					
					/*echo function_exists('proc_open');

					try{
						$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 25, 'ssl')
->setUsername('testmail11020@gmail.com')
->setPassword('rf123456');

						$mailer = Swift_Mailer::newInstance($transport);

						$message = Swift_Message::newInstance('Wonderful Subject')
							->setFrom(array('testmail11020@gmail.com' => 'EasyBuy'))
							->setTo(array('raselcse20@gmail.com', 'raselcse20@ymail.com' => 'A name'))
							->setBody('Here is the message itself');

						$result = $mailer->send($message);

						echo $result;
					}catch(Exception $e){
						echo 'Wrong';
					}	*/

					return Redirect::to('my_order');
				}
			}else{
				return 'not logged in';
			}

		}
	}

	public function myOrder(){
		if(Auth::user()){
			if(Auth::user()->check_user == 'yes'){
				$res = OrderModel::all();
				return View::make('order_list')
					->with('title', 'Order List | Easybuy')
					->with('res', $res);
			}

			else{
				$res = OrderModel::where('user_id', '=', Auth::user()->id)->get();
				return View::make('order_list')
					->with('title', 'Order List | Easybuy')
					->with('res', $res);
			}
		}
	}

	public function deleteOrder(){
		$in = Input::get('check_list');
		if(is_array($in)){
			$cnt = count($in);
			for($i=0;$i<$cnt;$i++){
				OrderModel::where('id', '=', $in[$i])->delete();
			}
		}
		return Redirect::to('my_order');
	}

	public function orderDetails($id){
		$res = OrderModel::select('ordered_items')->where('id', '=', $id)->get();
		$data = json_decode($res[0]->ordered_items);
		
		return View::make('order_details')
				->with('title', 'Order Details | Easybuy')
				->with('data', $data);
	}
}
