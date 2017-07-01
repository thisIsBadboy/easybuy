<!-- Modal Delete Confirmation Dialog -->
<div id="myDeleteConfirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border:none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="productName" class="modal-title">Are you sure?</h4>
            </div>

            <div class="modal-footer">
                <a id="deleteConfirmation" class="btn btn-danger" href="#">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal For Product Details -->
<div id="productDetail" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="prdName" class="modal-title">Name</h4>
            </div>
            <div class="modal-body">
                <img id="productImage" style="width:200px; height:160px;" class="img-rounded" src="img/blank.jpg" alt="" onmouseover="zoom(this)" onmouseout="$('#zoom-image').hide();">

                <img id="zoom-image" style="width: 350px;height: 300px;position:absolute; z-index:101; top:10px;right: 10px; transform: scale(1.5); display:none; border:1px solid grey;" src="img/blank.jpg" />

                <div id="div-productDescription">
                    <h4>Description</h4>
                    <p id="productDescription">Product Description</p>
                </div>

                <div id="div-productFeatures">
                    <h4>Features</h4>
                    <p id="productFeatures">Product Features</p>
                </div>

                <div id="div-productReviews">
                    <h4>Reviews</h4>
                    <button id = "btnAddReview" style="background:#FE980F;" class="btn btn-default" data-toggle="modal" @if(Auth::user())data-target="#myModalForReview"@else data-target="#myModalForLoggedMsg" @endif>Add Review</button>

                    <div id="prd-reviews">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal For Forgot Password -->
<div id="forgotPassword" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="productName" class="modal-title">Forgot Password?</h4>
            </div>
            <div class="modal-body" style="padding:30px 60px;">
                <div id="divForgotPass" class="form-group">
                    <input id="forgotPass" placeholder="Enter email" type="text" style="color:#DAC203" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnForgotPass" type="button" class="btn btn-default">Continue</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal For Category -->
<div id="productCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="productName" class="modal-title">New Category</h4>
            </div>
            <div class="modal-body" style="padding:30px 60px;">
                <input id="category" placeholder="Enter category" type="text" style="color:#DAC203" class="form-control" />
            </div>
            <div class="modal-footer">
                <button id="btnAddCategory" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@if(Route::current()->getName() == 'Product Page' || @Route::current()->getName() == 'Admin Panel')
<!-- Modal For SubCategory -->
<div id="productSubCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="productName" class="modal-title">New Sub-category</h4>
            </div>

            <div class="modal-body" style="padding:30px 60px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <select id="cat" class="form-control" name="category">
                                
                                @foreach($cat as $item)
                                <option value="{{$item->cat_name}}">{{$item->cat_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input id="sub-cat" placeholder="Enter Sub-category" type="text" style="color:#DAC203" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnAddSubCategory" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@endif

<!-- Modal For Sign Up -->
<div id="signup" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="productName" class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin:2% 15%">
                    <div id="div_SFName" class="form-group">
                        <div class="col-md-12">
                            <input id="SFName" type="text" style="color:#DAC203" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin:2% 15%">
                    <div id="div_SLName" class="form-group">
                        <div class="col-md-12">
                            <input id="SLName" type="text" style="color:#DAC203" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin:2% 15%">
                    <div id="div_SUName" class="form-group">
                        <div class="col-md-12">
                            <input id="SUName" type="text"style="color:#DAC203" class="form-control" name="user_name" placeholder="User Name">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin:2% 15%">
                    <div id="div_SPass" class="form-group">
                        <div class="col-md-12">
                            <input id="SPass" type="password" style="color:#DAC203" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin:2% 15%">
                    <div id="div_SPhone" class="form-group">
                        <div class="col-md-12">
                            <input id="SPhone" type="tel" style="color:#DAC203" class="form-control" name="contact" placeholder="Phone Number">
                        </div>
                    </div>
               </div>
            </div>

            <div class="modal-footer">
                <button id="btnSignUp" type="button" class="btn btn-default">Sign Up</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@if(Auth::user())
<!-- Modal For Name -->
<div id="myModalForName" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Name</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <input id="firstName" type="text" style="color:#DAC203" class="form-control" value="{{Auth::user()->first_name}}">
                        &nbsp;
                    </div>
                    <div class="col-md-6">
                        <input id="lastName" type="text" style="color:#DAC203" class="form-control" value="{{Auth::user()->last_name}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSaveName" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Username -->
<div id="myModalForUsername" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Username</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input id="userName" type="text" style="color:#DAC203" class="form-control" value="{{Auth::user()->user_name}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSaveUsername" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Email -->
<div id="myModalForEmail" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Email</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input id="email" type="text" style="color:#DAC203" class="form-control" value="{{Auth::user()->email}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSaveEmail" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Password -->
<div id="myModalForPassword" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <input id="oldPassword" type="text" style="color:#DAC203" class="form-control" placeholder="Old Password">
                        &nbsp;
                    </div>
                    <div class="col-md-6">
                        <input id="newPassword" type="text" style="color:#DAC203" class="form-control" placeholder="New Password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSavePassword" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Phone -->
<div id="myModalForPhone" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Phone Number</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input id="phone" type="text" style="color:#DAC203" class="form-control" value="{{Auth::user()->contact}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSavePhone" type="button" class="btn btn-default">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal For Logged Message -->
<div id="myModalForLoggedMsg" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Please login!!</h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal For Payment -->
<div id="myModalForPaymentMethod" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Payment Method</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-left:9%;">
                            <div id="bKash"><h3><input id="bkashRadio" type="radio" value="bkash" name="payment_method"/><span style="margin-left:5px;">bKash</span></h3></div>
                            <div id="cashOnDelivery"><h3><input id="cashOnDeliveryRadio" type="radio" checked value="cash_on_delivery" name="payment_method"/><span style="margin-left:5px;">Cash On Delivery</span></h3></div>
                        </div>

                        <div style="margin:50px;">
                            <div style="width:30%; float:left;">
                                <label id="lblMob">Mobile Number</label>
                            </div>
                            <div id="div-orderMobile" style="width:60%; float:left;">
                                <input id="orderMobile" maxlength="11" type="text" class="form-control" placeholder="Mobile"/>
                            </div>
                        </div>
                        <br/>
                        {{--
                        <div style="margin:35px 50px 50px 50px;">
                            <div style="width:30%; float:left;">
                                <label id="">Alternative Mobile Number</label>
                            </div>
                            <div id="div-orderMobile" style="width:60%; float:left;">
                                <input id="orderAltMobile" maxlength="11" type="text" class="form-control" placeholder="Alternative Mobile"/>
                            </div>
                        </div>

                        <br/>
                        --}}
                        <div style="margin:50px;">
                            <div style="width:30%; float:left;"><label>Where to</label></div>
                            <div style="width:60%; float:left;">
                                <div id="div-orderAddressLine1">
                                    <input id="orderAddressLine1" type="text" class="form-control" placeholder="Address Line 1"/>
                                </div>

                                <br/>

                                {{--
                                <div id="div-orderAddressLine2">
                                    <input id="orderAddressLine2" type="text" class="form-control" placeholder="Address Line 2"/>
                                </div>

                                <br/>
                                --}}
                                
                                <div id="div-orderUpazilla">
                                    <input id="orderUpazilla" type="text" class="form-control" placeholder="Upazilla"/>
                                </div>

                                <br/>

                                <div id="div-orderDistrict">
                                    <input id="orderDistrict" type="text" class="form-control" placeholder="District"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnProceed" type="button" class="btn btn-default">Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal For Feedback -->
<div id="myModalForFeedback" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Give us feedback</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin:20px 50px;">
                            <div id="div-feedbackName">
                                <input id="feedbackName" type="text" class="form-control" placeholder="Name"/>
                            </div>

                            <br/>
                            
                            <div id="div-feedbackEmail">
                                <input id="feedbackEmail" type="text" class="form-control" placeholder="Email"/>
                            </div>

                            <br/>

                            <div id="div-feedbackMobile">
                                <input id="feedbackMobile" type="text" maxlength="11" class="form-control" placeholder="Mobile"/>
                            </div>

                            <br/>
                            
                            <div style="text-align:center;">
                                <input id="feedbackStatus1" type="radio" checked name="feedback_status"/><span style="margin-left:5px;">Satisfied</span>
                                <input id="feedbackStatus2" type="radio" name="feedback_status"/><span style="margin-left:5px;">Not Satisfied</span>
                            </div><br/>
                            
                            <div id="div-feedbackText">
                                <textarea id="feedbackText" rows="3" class="form-control" placeholder="Write your feedback..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnFeedback" type="button" class="btn btn-default">Submit Feedback</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal For Feedback -->
<div id="myModalForReview" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Post your review</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin:20px 50px;">

                            <input id="reviewProductId" type="hidden" value=""/>

                            <div id="div-reviewName">
                                <input id="reviewName" type="text" class="form-control" placeholder="Name"/>
                            </div>

                            <br/>
                            
                            <div id="div-reviewEmail">
                                <input id="reviewEmail" type="text" class="form-control" placeholder="Email"/>
                            </div>

                            <br/>
                            
                            <div id="div-reviewText">
                                <textarea id="reviewText" rows="3" class="form-control" placeholder="Write your reivew..."></textarea>
                            </div>
                            
                            <br/>

                            <input id="rating" type="hidden" value = "1"/>
                            <div id="reviewRating">
                                <img style="height:20px; cursor:pointer;" onclick="changeRatingStar(1)" src="images/product-details/star-select.png"/>
                                <img style="height:20px; cursor:pointer;" onclick="changeRatingStar(2)" src="images/product-details/star.png"/>
                                <img style="height:20px; cursor:pointer;" onclick="changeRatingStar(3)" src="images/product-details/star.png"/>
                                <img style="height:20px; cursor:pointer;" onclick="changeRatingStar(4)" src="images/product-details/star.png"/>
                                <img style="height:20px; cursor:pointer;" onclick="changeRatingStar(5)" src="images/product-details/star.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnReview" type="button" class="btn btn-default">Submit Review</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>