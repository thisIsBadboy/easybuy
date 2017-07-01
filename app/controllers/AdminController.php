<?php

class AdminController extends BaseController{

	public function getAdminPanel(){
		$order = array();
		$sale = array();
		$day = array(1, 7, 30, 'all');
		
		$orderHistoryName = array("TODAY'S ORDER", "THIS WEEK'S ORDER", "THIS MONTH'S ORDER", "ALL ORDER");
		$saleHistoryName = array("TODAY'S SALE", "THIS WEEK'S SALE", "THIS MONTH'S SALE", "ALL SALE");

		for($i=0; $i<4; $i++){
			if($i < 3){
				$res = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(NOW(), order_time) >=0 AND DATEDIFF(NOW(), order_time) < '.$day[$i]);
			}else{
				$res = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list');
			}
			//echo 'Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(NOW(), order_time) < '.$day[$i];
			//echo "<br/>";

			$order[$i][1] = $res[0]->cnt;

			if($res[0]->total_price == NULL)
				$order[$i][2] = 0;
			else
				$order[$i][2] = $res[0]->total_price;
			//print_r($order);
		}

		//echo $order[0][1];

		//$todayOrder = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(order_time, NOW()) < 1');
		//$weekOrder = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(order_time, NOW()) < 7');
		//$monthOrder = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(order_time, NOW()) < 30');

		/*$todaySale = DB::select('Select count(*) as total from order_list where DATEDIFF(payment_time, NOW()) < 1');
		$weekSale = DB::select('Select count(*) as total from order_list where DATEDIFF(payment_time, NOW()) < 7');
		$monthSale = DB::select('Select count(*) as total from order_list where DATEDIFF(payment_time, NOW()) < 30');*/

		for($i=0; $i<4; $i++){
			if($i<3){
				$res = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(NOW(), payment_time) >=0 AND DATEDIFF(NOW(), payment_time) < '.$day[$i]);
			}else{
				$res = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list');
			}
			//echo 'Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(NOW(), order_time) < '.$day[$i];
			//echo "<br/>";

			$sale[$i][1] = $res[0]->cnt;
			
			if($res[0]->total_price == NULL)
				$sale[$i][2] = 0;
			else
				$sale[$i][2] = $res[0]->total_price;
			//print_r($order);
		}

		$cat = CategoryModel::select('cat_name')->get();
		$sub_cat = DB::table('sub_category')->select('cat_name', 'sub_cat_name')->get();

		return View::make('admin_panel')
				->with('title', 'Admin panel | Easybuy')
				->with('orderHistoryName', $orderHistoryName)
				->with('order', $order)
				->with('saleHistoryName', $saleHistoryName)
				->with('sale', $sale)
				->with('cat', $cat)
				->with('sub_cat', $sub_cat)
				->with('day', $day);
	}

	public function getHistory(){
		$history_type = Input::get('history_type');
		$history_day = Input::get('history_day');

		if($history_type == 'order_history'){

			$res = DB::select('Select * from order_list where DATEDIFF(NOW(), order_time) >=0 AND DATEDIFF(NOW(), order_time) < '.$history_day);

			return View::make('order_list')
					->with('title', 'Order History | Easybuy')
					->with('res', $res);

		}elseif($history_type == 'sale_history'){
			$res = DB::select('Select * from order_list where DATEDIFF(NOW(), payment_time) >=0 AND DATEDIFF(NOW(), payment_time) < '.$history_day);

			return View::make('order_list')
					->with('title', 'Sale History | Easybuy')
					->with('res', $res);
		}
	}

}