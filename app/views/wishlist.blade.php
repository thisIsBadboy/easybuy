@extends('common')

@section('body')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li class="active">Wishlist</li>
			</ol>
		</div>

		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td style="text-align: center;" class="image">Item</td>
						<td style="text-align: center;" class="description"></td>
						<td style="text-align: center;" class="price">Price</td>
						<td class="quantity"></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
				@foreach($wishlist as $item)
					<tr>
						<td class="cart_product" style="margin-right:0px;">
							<a href=""><img style="width:120px; height:100px;" src="img/{{$item->product_image}}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a id="ProductDetail-{{$item->id}}" href="#productDetail" data-toggle="modal" onclick="showDetail(this.id)">{{$item->product_name}}</a></h4>
						</td>
						<td style="text-align: center;" class="cart_price">
							<p>{{'TK', $item->price}}</p>
						</td>
						<td class="cart_quantity">
							<button id="AddToCart-{{$item->id}}" style="width:120px; margin-bottom: 0px;" class="btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
						</td>

						<td class="cart_delete" style="margin-right:0px;">
							<a class="cart_quantity_delete" href="remove_from_wishlist_{{$item->id}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->

@endsection