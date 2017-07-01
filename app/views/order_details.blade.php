@extends('common')

@section('body')

<section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="my_order">Order</a></li>
                  <li class="active">Order Detail</li>
                </ol>
            </div>
            
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td style="text-align: center;" class="image">Item</td>
                            <td style="text-align: center;" class="description"></td>
                            <td style="text-align: center;" class="price">Price</td>
                            <td style="text-align: center;" class="quantity">Quantity</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)

                    {{--*/ $img = ProductModel::find($row->id)['product_image'] /*--}}

                        <tr>
                            <td class="cart_product">
                                <a href=""><img style="width:120px; height:100px;" src="img/{{$img}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a id="ProductDetail-{{$row->id}}" href="#productDetail" data-toggle="modal" onclick="showDetail(this.id)">{{$row->name}}</a></h4>
                            </td>
                            <td style="text-align: center;" class="cart_price">
                                <p>{{'TK',$row->price}}</p>
                            </td>
                            <td style="text-align: center;" class="cart_quantity">
                                <p>{{$row->qty}}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection

