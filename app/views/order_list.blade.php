@extends('common')

@section('body')

<style>
.orderListHeader h5{
    font-weight: bold;
}
</style>

<div class="container">    
    <div style="margin-top:0%; margin-bottom:20px;" class="col-md-12 col-sm-12">
        <form method="POST" action="delete_order">
            <div class="panel panel-info">

                <table class="table table-hover">
                    <tr class="info orderListHeader" style="text-align:center;">
                        <td><h5>#</h5></td>

                        @if(Auth::user())
                        @if(Auth::user()->check_user=='yes')
                        <td><h5>Ref. No.</h5></td>
                        @endif
                        @endif

                        <td><h5>NO. OF ITEM</h5></td>
                        <td><h5>TOTAL AMOUNT</h5></td>

                        <td><h5>DETAILS</h5></td>

                        <td><h5>Payment Method</h5></td>
                        <td><h5>Mobile</h5></td>

                        @if(Auth::user())
                        @if(Auth::user()->check_user!='yes')
                        <td><h5>Payment</h5></td>
                        @endif
                        @endif

                        @if(Auth::user())
                        @if(Auth::user()->check_user=='yes')
                        <td><h5>Confirmation</h5></td>
                        @endif
                        @endif
                    </tr>

                    @foreach($res as $item)
                    <tr style="text-align:center;">
                        <td><input name="check_list[]" type="checkbox" value="{{$item->id}}"></td>

                        @if(Auth::user() && Auth::user()->check_user=='yes')
                        <td style="font-weight:bold">{{$item->ref_no}}</td>
                        @endif

                        <td>{{$item->no_of_item}}</td>
                        <td>{{$item->total_price}} TK</td>
                        
                        <td><a href="order_details-{{$item->id}}" style="background:seashell; border-radius:1px;" class="btn btn-default">DETAILS</a></td>


                        <td>{{$item->payment_method}}</td>
                        <td>{{$item->mobile}}</td>

                        @if(Auth::user())
                        @if(Auth::user()->check_user!='yes')
                        <td>
                            @if($item->payment_status == 0 && $item->payment_method=='bKash')
                            <a href="payment{{$item->id}}"><i class="fa fa-crosshairs"></i> Checkout</a> 

                            @elseif($item->payment_status == 0 && $item->payment_method=='Cash On Delivery')
                            <p>On your way</p>
                            @else 
                            <p>Paid, Thank you!!</p> 
                            @endif
                        </td>
                        @endif
                        @endif

                        @if(Auth::user())
                        @if(Auth::user()->check_user=='yes')
                        <td><button type="button" id="ChangePaymentStatus-{{$item->id}}" class="form-control btn @if($item->payment_status == 0) btn-danger @else btn-success @endif">@if($item->payment_status == 0) Not paid @else Paid @endif</button></td>
                        @endif
                        @endif

                    </tr>
                    @endforeach
                </table> 
            </div> 

            @if(Auth::user())
            @if(Auth::user()->check_user == 'yes')
            <div >
                <input type="submit" class="btn btn-default" value="Delete" />
            </div>
            @endif
            @endif
        </form>    
    </div> 
</div>

@endsection
