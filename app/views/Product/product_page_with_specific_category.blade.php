 @extends('common')

 @section('body')
 <div class="container">    
    <div style="margin-top:0%%;" class="col-md-12">  

        <div class="row">

            @include('Product.product_side_bar')

            <div class="col-md-9">

                @if($totalShowingSubCat != 0)
                @for($i=0;$i<$totalShowingSubCat;$i++)
                
                <h2 id="{{$cat[$i]->cat_name}}" class="title text-center">{{$showingCat}} / {{$showingSubCat[$i]->sub_cat_name}}</h2>

                <div class="row">
                    @foreach($prd as $p)
                    @if($p->sub_category == $showingSubCat[$i]->sub_cat_name)
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <div class="thumbnail">

                            @if(Auth::user())
                            @if(Auth::user()->check_user == 'yes')
                            <div style="height:35px;">
                                <button style="float:left; margin-bottom:5px;" class="btn btn-danger" data-toggle="modal" data-target="#myDeleteConfirmModal" onclick="setDeleteReference('delete_product{{$p->id}}')">Delete</button>
                                <a style="float:right; margin-bottom:5px;" class="btn btn-default" href="update_product-{{$p->id}}">Update</a>
                            </div>
                            @endif
                            @endif 

                            <div style="text-align:center;">
                                <img class="img-rounded" style="width:185px; height:170px;" src="img/{{$p->product_image}}" alt="">

                                @if($p->off != 0)
                                <div style="background: none repeat scroll 0% 0% rgb(218, 86, 46); color: white; padding: 0px 3px; position: absolute; z-index: 10; right: 16px; top: 50px; font-weight:bold;">{{$p->off, '% OFF'}}</div>
                                @endif
                            </div>

                            <div>
                                <div class="caption">
                                    <div style="height:65px; width:145px; float:left;"><a style="font-weight:bold; color:rgb(97, 107, 33);" id="ProductDetail-{{$p->id}}" href="#productDetail" data-toggle="modal">{{$p->product_name}}</a></div>
                                    @if($p->off != 0)
                                    <span style="font-weight:bold; float:right; @if($p->off != 0) color:red; text-decoration:line-through @endif">{{'TK ', $p->real_price}}</span><br/>
                                    <span style="font-weight:bold; float:right; color:green;">{{'TK ', $p->price}}</span>
                                    @else
                                    <span style="font-weight:bold; float:right; color:green;">{{'TK ', $p->price}}</span>
                                    @endif
                                </div>
                                <button id="AddToCart-{{$p->id}}" class="form-control btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart @if(Auth::user() && Auth::user()->check_user == 'yes')<span class="badge">{{$p->no_of_item - $p->sell_qty}}@endif</span></button>

                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a @if(Auth::user()) href="add_to_wishlist_{{$p->id}}" @else href="login" @endif><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>                       
                @endfor

                @else
                <h2 id="{{$showingCat}}" class="title text-center">{{$showingCat}}</h2>

                <div class="row">
                    @foreach($prd as $p)
                    @if($p->category == $showingCat)
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <div class="thumbnail">

                            @if(Auth::user())
                            @if(Auth::user()->check_user == 'yes')
                            <div style="height:35px;">
                                <a style="float:left; margin-bottom:5px;" class="btn btn-danger" href="delete_product{{$p->id}}">Delete</a>
                                <a style="float:right; margin-bottom:5px;" class="btn btn-default" href="update_product-{{$p->id}}">Update</a>
                            </div>
                            @endif
                            @endif 

                            <div style="text-align:center;">
                                <img class="img-rounded" style="width:185px; height:170px;" src="img/{{$p->product_image}}" alt="">

                                @if($p->off != 0)
                                <div style="background: none repeat scroll 0% 0% rgb(218, 86, 46); color: white; padding: 0px 3px; position: absolute; z-index: 10; right: 16px; top: 50px; font-weight:bold;">{{$p->off, '% OFF'}}</div>
                                @endif
                            </div>

                            <div>
                                <div class="caption">
                                    <div style="height:65px; width:145px; float:left;"><a style="font-weight:bold;" id="ProductDetail-{{$p->id}}" href="#productDetail" data-toggle="modal">{{$p->product_name}}</a></div>
                                    @if($p->off != 0)
                                    <span style="font-weight:bold; float:right; @if($p->off != 0) color:red; text-decoration:line-through @endif">{{'TK ', $p->real_price}}</span><br/>
                                    <span style="font-weight:bold; float:right; color:green;">{{'TK ', $p->price}}</span>
                                    @else
                                    <span style="font-weight:bold; float:right; color:green;">{{'TK ', $p->price}}</span>
                                    @endif
                                </div>
                                <button id="AddToCart-{{$p->id}}" class="form-control btn btn-success"><i class="fa fa-shopping-cart"></i> Add to Cart @if(Auth::user() && Auth::user()->check_user == 'yes')<span class="badge">{{$p->no_of_item - $p->sell_qty}}@endif</span></button>

                                &nbsp;
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a @if(Auth::user()) href="add_to_wishlist_{{$p->id}}" @else href="login" @endif><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif

            </div>

        </div>
    </div>        
</div>
@endsection