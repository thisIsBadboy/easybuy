<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{$title}}</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <script src="js/jquery.js"></script>
    @include('Javascript.myJavaScript')
    @include('Javascript.productJavascript')
</head>

<body id="page-top" class="index">

    <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="/"><img src="images/home/logo-easybuy.png" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @if(Route::current()->getName() == 'Home')
                                <li><a style="font-size:17px;" class="page-scroll" href="#latest">Latest</a></li>
                                <li><a style="font-size:17px;" class="page-scroll" href="#specialOffer">Special Offer</a></li>
                                <li><a style="font-size:17px;" class="page-scroll" href="#popular">Top Deals</a></li>
                                @else
                                    <li><a style="font-size:17px;" class="page-scroll" href="/#latest">Latest</a></li>
                                    <li><a style="font-size:17px;" class="page-scroll" href="/#specialOffer">Special Offer</a></li>
                                    <li><a style="font-size:17px;" class="page-scroll" href="/#popular">Top Deals</a></li>
                                @endif

                                <li><a style="font-size:17px;" href="cart"><i class="fa fa-shopping-cart"></i> Cart <b id="cart">{{Cart::count()}}</b></a></li>

                                <li><a style="font-size:17px;" @if(Auth::user()) href="wishlist" @else href="login" @endif><i class="fa fa-star"></i> Wishlist</a></li>

                                @if(Auth::user())
                                <li><a style="font-size:17px;" href="profile"><i class="fa fa-user"></i> {{'Hi, ', Auth::user()->first_name}}</a></li>
                                @else
                                <li><a style="font-size:17px;" href="login"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="/" class="active">Home</a></li>

                                @if(Auth::user())
                                @if(Auth::user()->check_user=='yes')
                                <li class="dropdown">
                                    <a href="javascript:void(0)">Message<span id="msgCount" class="badge">0</span><i class="fa fa-angle-down"></i></a>
                                    <ul id="sentMsgList" role="menu" class="sub-menu" >    
                                        {{-- <li><a href="#">Dropdown</a></li> --}}
                                    </ul>
                                </li>

                                @else
                                <li><a class="page-scroll" href="golpo_with_admin">Chat</a></li>
                                @endif
                                @endif

                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="product_page">Products</a></li>
                                        @if(Auth::user())
                                        <li><a href="my_order">Order List</a></li> 
                                        @endif
                                        <li><a href="cart">Cart</a></li> 
                                        <li><a @if(Auth::user()) href="wishlist" @else href="login" @endif>Wishlist</a></li>
                                        @if(Auth::user())
                                        <li><a href="logout">Logout</a></li> 
                                        @else
                                        <li><a href="login">Login</a></li> 
                                        @endif
                                    </ul>
                                </li> 
                                <li><a href="contact_us">Contact</a></li>
                                @if(Auth::user())
                                @if(Auth::user()->check_user=='yes')
                                <li><a href="admin_panel">Admin panel</a></li>
                                @endif
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form method="POST" action="search_product">
                                <input name="search" type="text" placeholder="Search"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    @yield('body')

    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="companyinfo">
                            <h2><span>easy</span>buy</h2>
                            <p>Make your choice and get your product.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="contact_us">Contact Us</a></li>
                                <li><a href="my_order">Order Status</a></li>
                                <li><a href="feedback">Feedback</a></li>
                                <li><a href="">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="">T-Shirt</a></li>
                                <li><a href="">Mens</a></li>
                                <li><a href="">Womens</a></li>
                                <li><a href="">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="policy#terms-of-use">Terms of Use</a></li>
                                <li><a href="policy#privacy-policy">Privacy Policy</a></li>
                                <li><a href="policy#billing-system">Billing System</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2016 EASYBUY. All rights reserved.</p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->

    @include('modal')

    
    <script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
