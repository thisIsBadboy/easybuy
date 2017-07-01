<?php

class ProductModel extends Eloquent{

	public $timestamps = false;
	public $table = 'products_info';
	public static $rules = array('product_name'=>'required|max:200', 'description'=>'max:500','no_of_item'=>'required|min:1','price'=>'required|min:1');
}
