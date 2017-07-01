<?php 

class PaymentController extends BaseController{
	
	function getbKashPage($id){
		$res = OrderModel::select('ref_no')->where(array('id'=>$id))->get();
		return View::make('bkash')
				->with('title', 'Checkout')
				->with('ref', $res[0]->ref_no);
	}

	function changePaymentStatus(){
		if(Request::ajax()){
			try{
				$in = Input::all();
				$res = OrderModel::select('payment_status')->where('id','=',$in['id'])->get();

				$result = OrderModel::select('ordered_items')->where('id', '=', $in['id'])->get();
				$data = json_decode($result[0]->ordered_items);

				if($res[0]->payment_status == 0){
					$thisMoment = DB::select('Select NOW() as this_time');
					OrderModel::where('id','=',$in['id'])->update(array('payment_status'=>1, 'payment_time'=>$thisMoment[0]->this_time));
					
					foreach($data as $row){
						$v = ProductModel::select('sell_qty')->where('id','=',$row->id)->get();
						ProductModel::where('id','=',$row->id)->update(array('sell_qty'=>($v[0]->sell_qty+$row->qty)));
					}
				}

				if($res[0]->payment_status == 1){
					OrderModel::where('id','=',$in['id'])->update(array('payment_status'=>0, 'payment_time'=>0));

					foreach($data as $row){
						$v = ProductModel::select('sell_qty')->where('id','=',$row->id)->get();
						ProductModel::where('id','=',$row->id)->update(array('sell_qty'=>($v[0]->sell_qty-$row->qty)));
					}
				}

				return $res[0]->payment_status;
			}catch(Exception $e){
				return "error";
			}
		}
	}
}