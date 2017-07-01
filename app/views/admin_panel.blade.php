@extends('common')

@section('body')

<div class="container">  
    <div style="margin-top:0%;" class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-body" >
                <a class="col-md-3 btn btn-default" style="margin:1% 4%; background:gold;" href="#productCategory" data-toggle="modal">Add Category</a>
                <a class="col-md-3 btn btn-default" style="margin:1% 4%; background:gold;" href="#productSubCategory" data-toggle="modal">Add SubCategory</a>
                <a class="col-md-3 btn btn-default" style="margin:1% 4%; background:gold;" href="add_new_product">Add Product</a>
            </div>
        </div>   

        <div>
            <h2 class="title text-center">Order History</h2>
            <table class="table table-hover">
                    <tr class="info" style="text-align:center;">
                        <td><h5 style="font-weight: bold;">NAME</h5></td>
                        <td><h5 style="font-weight: bold;">NO. OF ORDER</h5></td>
                        <td><h5 style="font-weight: bold;">TOTAL AMOUNT</h5></td>
                    </tr>

                    @for($i=0; $i<4; $i++)

                    <tr style="text-align:center;">
                        <td><a href="get_history?history_type=order_history&history_day={{$day[$i]}}">{{$orderHistoryName[$i]}}</a></td>
                        <td><h5>{{$order[$i][1]}}</h5></td>
                        <td><h5>TK{{$order[$i][2]}}</h5></td>
                    </tr>

                    @endfor
                </table>
        </div>  

        <div>
            <h2 class="title text-center">Sale History</h2>
            <table class="table table-hover">
                    <tr class="info" style="text-align:center;">
                        <td><h5 style="font-weight: bold;">NAME</h5></td>
                        <td><h5 style="font-weight: bold;">NO. OF SALE</h5></td>
                        <td><h5 style="font-weight: bold;">TOTAL AMOUNT</h5></td>
                    </tr>

                    @for($i=0;$i<4;$i++)

                    <tr style="text-align:center;">
                        <td><a href="get_history?history_type=sale_history&history_day={{$day[$i]}}">{{$saleHistoryName[$i]}}</a></td>
                        <td><h5>{{$sale[$i][1]}}</h5></td>
                        <td><h5>TK{{$sale[$i][2]}}</h5></td>
                    </tr>

                    @endfor
            </table>
        </div>
    
        <div style="text-align:center; padding:20px; font-size:20px;">
            <a href="contact_messages" style="color:red;">Contact Messages</a>
        </div>
    </div> 
</div>

@endsection