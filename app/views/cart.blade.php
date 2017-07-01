@extends('common')

@section('body')
<div class="container">  

    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li class="active">Shopping Cart</li>
      </ol>
    </div>

    <div style="margin-top:-5%;" class="col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">

            <div id="pnl-body" class="panel-body" >

                @if(Cart::count() == 0)
                <div><h1>Your cart is empty!!!</h1></div>

                @else
                {{--*/ $content = Cart::content(); /*--}}
                
                <div class="row">
                    @foreach($content as $row)

                    {{--*/ $img = ProductModel::find($row->id)['product_image']; /*--}}

                    <div id="div{{$row->rowid}}" class="col-md-4 col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <div style="text-align:center;">
                                <div class="cart_delete" style="position:absolute; top:0px; left:13px; width:32px;">
                                    <a class="cart_quantity_delete" href="javascript:void(0)" onclick="removeFromCartByCross('{{$row->rowid}}')"><i class="fa fa-times"></i></a>
                                </div>

                                <img class="img-rounded" style="width:185px; height:170px;" src="img/{{$img}}" alt="">
                                
                                @if(ProductModel::find($row->id)['latest'] == 1)
                                <img style="margin-right:15px;" src="images/home/new.png" class="new" alt="">
                                @endif

                                @if(ProductModel::find($row->id)['off'] != 0)
                                    <div style="background: none repeat scroll 0% 0% rgb(218, 86, 46); color: white; padding: 0px 3px; position: absolute; z-index: 10; right: 16px; top: 50px; font-weight:bold;">{{ProductModel::find($row->id)['off'], '% OFF'}}</div>
                                @endif
                            </div>

                            <div>
                                <div class="caption">
                                    <div style="height:65px; width:145px; float:left;">
                                        <a style="font-weight:bold; color:rgb(97, 107, 33);" id="ProductDetail-{{$row->id}}" href="#productDetail" data-toggle="modal">{{$row->name}}</a>
                                    </div>

                                    @if(ProductModel::find($row->id)['off'] != 0)
                                        <span style="font-weight:bold; float:right; @if(ProductModel::find($row->id)['off'] != 0) color:red; text-decoration:line-through @endif">{{'TK ', ProductModel::find($row->id)['real_price']}}</span>
                                        <br/>
                                        <span style="font-weight:bold; float:right; color:green;">{{'TK ', ProductModel::find($row->id)['price']}}</span>
                                    
                                    @else
                                        <span style="font-weight:bold; float:right; color:green;">{{'TK ', ProductModel::find($row->id)['price']}}</span>
                                    
                                    @endif
                                </div>

                                <div style="display:inline-block; width:100%; text-align:center;">
                                    <span id="price{{$row->rowid}}" style="font-size:18px; font-weight:bold; color:rgb(239, 135, 0);">Sub total = {{'TK', $row->subtotal}}</span>
                                </div>

                                <div class="cart_quantity_button" style="display:inline-block; margin-left:70px;">
                                    <a id="RemoveFromCart-{{$row->rowid}}-minus" class="cart_quantity_down" style="text-decoration:none;" href="javascript:void(0)"> - </a>

                                    <input id="box-{{$row->rowid}}" class="cart_quantity_input" type="text" name="quantity" value="{{$row->qty}}" autocomplete="off" size="2" maxlength="2" onkeypress="return validateCartInput(this.id, event)" onchange="addToCartByHand(this.id)">

                                    <a id="AddToCart-{{$row->rowid}}-plus" class="cart_quantity_up" style="text-decoration:none;" href="javascript:void(0)"> + </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                @endif
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6" style="height:100px;">
                        <div style="width:200px; border-bottom:1px solid green;">
                            <label>Item Price:</label> <span id="totalPrice" style="float:right; font-weight:bold;">TK{{Cart::total()}}</span>
                            
                            <label>Shipping cost: </label><span id="shippingCost" style="float:right; font-weight:bold;">+@if(Cart::count() != 0) TK50 @else TK0 @endif</span>
                        </div>
                        <div style="width:200px;">
                            <label>Total cost: </label><span id="priceWithShipping" style="float:right; font-weight:bold;">@if(Cart::count() != 0) TK{{Cart::total()+50}} @else TK0 @endif</span>
                        </div>
                    </div>
                    <div class="col-md-3"><input type="button" id="btnClearCart" class="form-control btn btn-default @if(Cart::count() == 0) disabled @endif" value="Clear Cart">&nbsp;</div>

                    <div class="col-md-3"><input type="button" data-toggle="modal" id="btnOrder" class="form-control btn btn-default @if(Cart::count() == 0) disabled @endif" @if(Auth::user()) data-target="#myModalForPaymentMethod" @else data-target="#myModalForLoggedMsg" @endif value="Order Now"></div>
                </div>
            </div>

        </div>      
    </div> 
</div>
@endsection

