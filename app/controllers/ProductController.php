<?php

class ProductController extends BaseController{

	public function getProductPage(){

		$prd = array();
		$isCatExceed = array();
		$cat = CategoryModel::select('id', 'cat_name')->orderBy('priority', 'desc')->get();
		$sub_cat = DB::table('sub_category')->select('id', 'cat_name', 'sub_cat_name')->get();

		/******* For Product Page Side Bar*****/
		$corSubCat = array();
		$corSubCatCnt = array();

		$lenCat = count($cat);
		$lenSubCat = count($sub_cat);

		for($i=0;$i<$lenCat;$i++){
			for($j=0, $k=0;$j<$lenSubCat;$j++){
				if($cat[$i]->cat_name == $sub_cat[$j]->cat_name){
					$corSubCat[$i][$k++] = $sub_cat[$j]->sub_cat_name;
				}
			}

			$corSubCatCnt[$i] = $k;
		}
		/************End Side Bar************/

		$k=0;
		$eachCatLimit = 36;
		$totalCat = count($cat);
		for($i=0;$i<$totalCat;$i++){
			$res = ProductModel::where(array('category'=>$cat[$i]->cat_name))->take($eachCatLimit+1)->get();
			$sz = count($res);

			if($sz == 0){
				$isCatExceed[$i] = 0;
			}elseif($sz <= $eachCatLimit){
				$isCatExceed[$i] = 1;
			}else{
				$sz = $eachCatLimit;
				$isCatExceed[$i] = 2;
			}

			for($j=0;$j<$sz;$j++){
				$prd[$k++] = $res[$j];
			}
		}

		return View::make('Product.product_page')
					->with('title', 'Product | Easybuy')
					->with('prd', $prd)
					->with('isCatExceed', $isCatExceed)
					->with('cat', $cat)
					->with('cat_len', $lenCat)
					->with('sub_cat', $sub_cat)
					->with('sub_cat_len', $lenSubCat)
					->with('corSubCatCnt', $corSubCatCnt)
					->with('corSubCat', $corSubCat);
	}

	public function getCategorySpecificPage(){

		$cat = CategoryModel::select('id', 'cat_name')->orderBy('priority', 'desc')->get();
		$sub_cat = DB::table('sub_category')->select('id', 'cat_name', 'sub_cat_name')->get();

		/******* For Product Page Side Bar*****/
		$corSubCat = array();
		$corSubCatCnt = array();

		$lenCat = count($cat);
		$lenSubCat = count($sub_cat);

		for($i=0;$i<$lenCat;$i++){
			for($j=0, $k=0;$j<$lenSubCat;$j++){
				if($cat[$i]->cat_name == $sub_cat[$j]->cat_name){
					$corSubCat[$i][$k++] = $sub_cat[$j]->sub_cat_name;
				}
			}

			$corSubCatCnt[$i] = $k;
		}
		/************End Side Bar************/

		$showingCat = Input::get('category');

		if(Input::get('sub_category') == 'all'){
		
			$showingSubCat = DB::table('sub_category')->where(array('cat_name'=>$showingCat))->get();
		
			$prd = ProductModel::where(array('category'=>Input::get('category')))->get();
		
		}else{
			$showingSubCat = DB::table('sub_category')->where(array('cat_name'=>$showingCat, 'sub_cat_name'=>Input::get('sub_category')))->get();

			$prd = ProductModel::where(array('category'=>Input::get('category'), 'sub_category'=>Input::get('sub_category')))->get();
		}

		return View::make('Product.product_page_with_specific_category')
					->with('title', 'Product | Easybuy')
					->with('cat', $cat)
					->with('cat_len', $lenCat)
					->with('sub_cat', $sub_cat)
					->with('sub_cat_len', $lenSubCat)
					->with('corSubCatCnt', $corSubCatCnt)
					->with('corSubCat', $corSubCat)
					->with('prd', $prd)
					->with('showingCat', $showingCat)
					->with('totalShowingSubCat', count($showingSubCat))
					->with('showingSubCat', $showingSubCat);
	}

	public function getAddNewProductPage(){
		$cat = CategoryModel::all();
		return View::make('Product.add_product_page')
					->with('title', 'Add new product | Easybuy')
					->with('cat', $cat);
	}

	public function addCategory(){
		$in = Input::all();
		try{
			$obj = new CategoryModel;
			$obj->cat_name = $in['category'];
			$obj->save();
			
			return 1;
		}catch(Exception $e){
			return 0;
		}
	}

	public function addSubCategory(){
		if(Request::ajax()){
			$in = Input::all();
			$insertId = DB::table('sub_category')->insertGetId(array('cat_name'=>$in['cat'], 'sub_cat_name'=>$in['sub-cat']));

			return $insertId;
		}
	}

	public function newProduct(){
		
		$in = Input::all();
		$v = Validator::make($in, ProductModel::$rules);

		if($v->fails()){
			return Redirect::to('add_new_product')->withErrors($v);
		}

		else{
				$productObj = new ProductModel;
				$productObj->category = $in['category'];
				$productObj->sub_category = isset($in['sub_cat'])?$in['sub_cat']:"";
				$productObj->product_name = $in['product_name'];
				$productObj->description = $in['description'];
				$productObj->features = $in['features'];
				$productObj->no_of_item = $in['no_of_item'];
				$productObj->real_price = $in['price'];
				$productObj->price = $in['price'] - (($in['price']*$in['off'])/100);

				if(isset($in['latest'])){
					$productObj->latest = 1;
				}

				$productObj->off = $in['off'];

				$file = Input::file('file');

				if($file != null){
					$file_name = rand(0, 100).$file->getClientOriginalName();
					$ext = $file->getClientOriginalExtension();

					$destination_path = '..\public\img';
		        	$file->move($destination_path, $file_name); 
					$productObj->product_image = $file_name;
    			}

    			else
    				$productObj->product_image = 'blank.jpg';

    			$thisMoment = DB::select('Select NOW() as this_time');
    			$productObj->created_time = $thisMoment[0]->this_time;

				$productObj->save();

				$prd = ProductModel::all();
				$cat = CategoryModel::all();


				$order = array();
				$sale = array();
				$day = array(1, 7, 30);
				
				$orderHistoryName = ["TODAY'S ORDER", "THIS WEEK'S ORDER", "THIS MONTH'S ORDER"];
				$saleHistoryName = ["TODAY'S SALE", "THIS WEEK'S SALE", "THIS MONTH'S SALE"];

				for($i=0; $i<3; $i++){
					$res = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(NOW(), order_time) >=0 AND DATEDIFF(NOW(), order_time) < '.$day[$i]);

					$order[$i][1] = $res[0]->cnt;

					if($res[0]->total_price == NULL)
						$order[$i][2] = 0;
					else
						$order[$i][2] = $res[0]->total_price;
				}

				for($i=0; $i<3; $i++){
					$res = DB::select('Select count(*) as cnt, sum(total_price) as total_price from order_list where DATEDIFF(NOW(), payment_time) >=0 AND DATEDIFF(NOW(), payment_time) < '.$day[$i]);

					$sale[$i][1] = $res[0]->cnt;
					
					if($res[0]->total_price == NULL)
						$sale[$i][2] = 0;
					else
						$sale[$i][2] = $res[0]->total_price;
				}

			
				return View::make('admin_panel')
							->with('orderHistoryName', $orderHistoryName)
							->with('order', $order)
							->with('saleHistoryName', $saleHistoryName)
							->with('sale', $sale)
							->with('prd', $prd)
							->with('cat', $cat);
		}
	}

	public function getUpdateProductPage($id){
		$prd = ProductModel:: find ($id);
		$cat = CategoryModel::all();
		$sub_cat = DB::table('sub_category')->orderBy('sub_cat_name', 'desc')->get();
		return View::make('Product.update_product_page')
							->with('title', 'Update product | Easybuy')
							->with('prd', $prd)
							->with('cat', $cat)
							->with('sub_cat', $sub_cat);
	}

	public function updatedProduct($id){
		$in = Input::all();
		$prd = ProductModel:: find ($id);
		$v = Validator::make($in,ProductModel::$rules);

		if($v->fails()){
			return View::make('update_product_page')
			->with('prd', $prd)
			->withErrors($v);
		}

		else{

			$latest = 0;
			if(isset($in['latest'])){
					$latest = 1;
			}

			$thisMoment = DB::select('Select NOW() as this_time');

	 		ProductModel::where('id', '=', $id)
	 				->update(array('category'=>$in['category'], 
	 							'sub_category'=>isset($in['sub_cat'])?$in['sub_cat']:"", 
	 							'product_name'=>$in['product_name'],
	 							'no_of_item'=>$in['no_of_item'], 
	 							'real_price'=>$in['price'], 
	 							'price'=>($in['price']-(($in['price']*$in['off'])/100)), 
	 							'off'=>$in['off'], 
	 							'latest'=>$latest, 
	 							'description'=>$in['description'], 
	 							'features'=>$in['features'], 
	 							'updated_time'=>$thisMoment[0]->this_time));

			$file = Input::file('file');

			if($file != null){
	  			$file = Input::file('file');

				$file_name = rand(0, 100).$file->getClientOriginalName();
				$ext = $file->getClientOriginalExtension();

				$destination_path = '..\public\img';
		    	$file->move($destination_path, $file_name); 
				ProductModel::where('id', '=' ,$id)
							->update(array('product_image'=>$file_name));
			}

			return Redirect::to('product_page');
		}
	}

	public function deleteProduct($id){
	
	    $prd = ProductModel:: find ($id);
	    $prd -> delete();

	    return Redirect::to('product_page');
	}

	public function showDetail(){
		$in = Input::all();

		$res = DB::table('product_reviews')->where(array('pid'=>$in['id']))->orderBy('rating', 'desc')->get();

		$limit = 3;
		$review = "";
		$reviewCnt = count($res);
		
		if($reviewCnt > $limit){
			$len = $limit;
		}else{
			$len = $reviewCnt;
		}

		for($i=0;$i<$len;$i++){
			$review = $review.'<div style="border:1px solid rgb(237, 233, 233); padding:5px; margin:10px 15px 0px 15px; width:555px; border-radius:5px;" class="col-sm-12"><div style="margin-bottom:5px; font-weight:bold;"><i style="color:orange;" class="fa fa-user"></i> '.$res[$i]->name.' &nbsp; &nbsp;<i style="color:orange;" class="fa fa-clock-o"></i> '.date_format(date_create($res[$i]->review_time), 'H:i A').' &nbsp; &nbsp;<i style="color:orange;" class="fa fa-calendar-o"></i> '.date_format(date_create($res[$i]->review_time), 'd-M-Y').'</div><p>'.$res[$i]->review_text.'</p></div>';
		}

		if($reviewCnt > $limit){
			$review = $review.'<h4 style="text-align:center;"><a target="_blank" href="reviews'.$in['id'].'">See more reviews</a></h4>';
		}

		$review = '<div class="row">'.$review.'</div>';

		$prd = ProductModel::find($in['id']);
		$data = array('name'=>$prd['product_name'], 'description'=>$prd['description'], 'image'=>$prd['product_image'], 'features'=>$prd['features'], 'review'=>$review, 'review_cnt'=>$reviewCnt);

		return $data;
	}

	public function getSubCategory(){
		if(Request::ajax()){
			$in = Input::all();
			$res = DB::table('sub_category')->select('sub_cat_name')->where(array('cat_name'=>$in['cat']))->orderBy('sub_cat_name', 'desc')->get();

			return json_encode($res);
		}
	}

	public function searchProduct(){
		$in = Input::all();

		$isCatExceed = array();
		$cat = CategoryModel::select('cat_name')->orderBy('priority', 'desc')->get();
		$sub_cat = DB::table('sub_category')->select('cat_name', 'sub_cat_name')->get();

		/******* For Product Page Side Bar*****/
		$corSubCat = array();
		$corSubCatCnt = array();

		$lenCat = count($cat);
		$lenSubCat = count($sub_cat);

		for($i=0;$i<$lenCat;$i++){
			for($j=0, $k=0;$j<$lenSubCat;$j++){
				if($cat[$i]->cat_name == $sub_cat[$j]->cat_name){
					$corSubCat[$i][$k++] = $sub_cat[$j]->sub_cat_name;
				}
			}

			$corSubCatCnt[$i] = $k;
		}
		/************End Side Bar************/

		$l=0;
		$matchProduct = array();

		$searchString = $in['search'];
		$sArr = explode(' ', $searchString);
		$sLen = count($sArr);

		for($m=0;$m<$lenCat;$m++){
			$res = ProductModel::where(array('category'=>$cat[$m]->cat_name))->get();
			//$res = ProductModel::all();
			$len = count($res);
			$flag = 0;

			for($i=0;$i<$len;$i++){
				$prdNameArr = explode(' ', $res[$i]->product_name);
				$prdLen = count($prdNameArr);

				//var_dump($prdNameArr);

				for($j=0;$j<$prdLen;$j++){
					for($k=0;$k<$sLen;$k++){
						if(strtolower(trim($prdNameArr[$j])) == strtolower(trim($sArr[$k]))){
							//echo trim($prdNameArr[$j])."  ".trim($sArr[$k]).'<br/>';
							$matchProduct[$l++] = $res[$i];
							$flag = 1;
							break;
						}
					}
				}
			}

			if($flag == 1){
				$isCatExceed[$m] = 1;
			}else{
				$isCatExceed[$m] = 0;
			}
		}

		return View::make('Product.product_page')
					->with('title', 'Product | Easybuy')
					->with('prd', $matchProduct)
					->with('isCatExceed', $isCatExceed)
					->with('cat', $cat)
					->with('cat_len', $lenCat)
					->with('sub_cat', $sub_cat)
					->with('sub_cat_len', $lenSubCat)
					->with('corSubCatCnt', $corSubCatCnt)
					->with('corSubCat', $corSubCat);
	}

}