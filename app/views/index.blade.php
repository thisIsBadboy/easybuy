@extends('common')

@section('body')
<div class="container">

    <div style="margin-top:0%; margin-bottom:5%; " id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="img/slide/slide_1.jpg" alt="...">
                <div class="carousel-caption">
                    First
                </div>
            </div>
            <div class="item">
                <img src="img/slide/slide_2.jpg" alt="...">
                <div class="carousel-caption">
                    Second
                </div>
            </div>
            <div class="item">
                <img src="img/slide/slide_3.jpg" alt="...">
                <div class="carousel-caption">
                    Third
                </div>
            </div>
            <div class="item">
                <img src="img/slide/slide_4.jpg" alt="...">
                <div class="carousel-caption">
                    Fourth
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h2 class="title text-center">Latest</h2>

    <div id="latest" class="alert alert-success" role="alert" style="background:#e0caaf;">

        <div class="panel panel-info">

            <div class="panel-body" >

                <div class="row">
                    @foreach($latest as $l)
                    <div class="col-md-3 col-lg-3 col-sm-4">
                        <div class="thumbnail">
                            <img class="img-rounded" style="width:185px; height:170px;" src="img/{{$l->product_image}}" alt="">

                            @if($l->latest == 1)
                            <img style="margin-right:15px;" src="images/home/new.png" class="new" alt="">
                            @endif

                            @if($l->off != 0)
                                <div style="background: none repeat scroll 0% 0% rgb(218, 86, 46); color: white; padding: 0px 3px; position: absolute; z-index: 10; right: 16px; top: 50px; font-weight:bold;">{{$l->off, '% OFF'}}</div>
                            @endif

                            <div>
                                <div class="caption">
                                    <div style="height:65px; width:145px; float:left;"><a style="font-weight:bold; color:rgb(97, 107, 33);" id="ProductDetail-{{$l->id}}-l" href="#productDetail" data-toggle="modal">{{$l->product_name}}</a></div>
                                    @if($l->off != 0)
                                        <span style="font-weight:bold; float:right; @if($l->off != 0) color:red; text-decoration:line-through @endif">{{'TK ', $l->real_price}}</span><br/>
                                        <span style="font-weight:bold; float:right; color:green;">{{'TK ', $l->price}}</span>
                                    @else
                                        <span style="font-weight:bold; float:left; color:green;">{{'TK ', $l->price}}</span>
                                    @endif
                                </div>
                                <button id="AddToCart-{{$l->id}}-l" class="form-control btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>

                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a @if(Auth::user()) href="add_to_wishlist_{{$l->id}}" @else href="login" @endif><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div> 
    </div>

    <h2 class="title text-center">Special Offer</h2>

    <div id="specialOffer" class="alert alert-success" role="alert" style="background:#e0caaf;">

        <div class="panel panel-info">

            <div class="panel-body" >

                <div class="row">
                    @foreach($special as $s)
                    <div class="col-md-3 col-lg-3 col-sm-4">
                        <div class="thumbnail">
                            <div style="text-align:center;">
                                <img class="img-rounded" style="width:185px; height:170px;" src="img/{{$s->product_image}}" alt="">
                                
                                @if($s->latest == 1)
                                <img style="margin-right:15px;" src="images/home/new.png" class="new" alt="">
                                @endif

                                @if($s->off != 0)
                                    <div style="background: none repeat scroll 0% 0% rgb(218, 86, 46); color: white; padding: 0px 3px; position: absolute; z-index: 10; right: 16px; top: 50px; font-weight:bold;">{{$s->off, '% OFF'}}</div>
                                @endif
                            </div>
                            <div>
                                <div class="caption">
                                    <div style="height:65px; width:145px; float:left;"><a style="font-weight:bold; color:rgb(97, 107, 33);" id="ProductDetail-{{$s->id}}-s" href="#productDetail" data-toggle="modal">{{$s->product_name}}</a></div>
                                    @if($s->off != 0)
                                        <span style="font-weight:bold; float:right; @if($s->off != 0) color:red; text-decoration:line-through @endif">{{'TK ', $s->real_price}}</span><br/>
                                        <span style="font-weight:bold; float:right; color:green;">{{'TK ', $s->price}}</span>
                                    @else
                                        <span style="font-weight:bold; float:left; color:green;">{{'TK ', $s->price}}</span>
                                    @endif
                                </div>
                                <button id="AddToCart-{{$s->id}}-s" class="form-control btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a @if(Auth::user()) href="add_to_wishlist_{{$s->id}}" @else href="login" @endif><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> 
    </div>

    <h2 class="title text-center">Most Popular</h2>

    <div id="popular" class="alert alert-success" role="alert" style="background:#e0caaf;">
        <div class="panel panel-info">

            <div class="panel-body" >

                <div class="row">
                    @foreach($popular as $p)
                    <div class="col-md-3 col-lg-3 col-sm-4">
                        <div class="thumbnail">
                            <div style="text-align:center;">
                                <img class="img-rounded" style="width:185px; height:170px;" src="img/{{$p->product_image}}" alt="">
                                
                                @if($p->latest == 1)
                                <img style="margin-right:15px;" src="images/home/new.png" class="new" alt="">
                                @endif

                                @if($p->off != 0)
                                    <div style="background: none repeat scroll 0% 0% rgb(218, 86, 46); color: white; padding: 0px 3px; position: absolute; z-index: 10; right: 16px; top: 50px; font-weight:bold;">{{$p->off, '% OFF'}}</div>
                                @endif
                            </div>
                            <div>
                                <div class="caption">
                                    <div style="height:65px; width:145px; float:left;"><a style="font-weight:bold; color:rgb(97, 107, 33);" id="ProductDetail-{{$p->id}}-p" href="#productDetail" data-toggle="modal">{{$p->product_name}}</a></div>
                                    @if($p->off != 0)
                                        <span style="font-weight:bold; float:right; @if($p->off != 0) color:red; text-decoration:line-through @endif">{{'TK ', $p->real_price}}</span><br/>
                                        <span style="font-weight:bold; float:right; color:green;">{{'TK ', $p->price}}</span>
                                    @else
                                        <span style="font-weight:bold; float:left; color:green;">{{'TK ', $p->price}}</span>
                                    @endif
                                </div>
                                <button id="AddToCart-{{$p->id}}-p" class="form-control btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>

                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a @if(Auth::user()) href="add_to_wishlist_{{$p->id}}" @else href="login" @endif><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection