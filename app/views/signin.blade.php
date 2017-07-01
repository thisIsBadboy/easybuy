@if(Auth::user())

<li role="presentation" class="dropdown" style="background-color:#222222">
    
    <a class="dropdown-toggle" data-hover="dropdown" data-delay="1000"  style="background-color:#222222;color:#fff" href="javascript:void(0)" role="button" aria-expanded="false">{{'Hi, '}}{{Auth::user()->first_name}}<span class="caret"></span></a>
    <ul class="dropdown-menu" style="background-color:#222222">
        <li style= "padding-left:20px; padding-right:20px;"><a href="profile" style="color:#FEC50D;">Profile</a></li>
        <li style= "padding-left:20px; padding-right:20px;"><a href="my_order" style="color:#FEC50D;">@if(Auth::user()->check_user != 'yes'){{'My Order'}}@else{{'Order List'}}@endif</a></li>
        @if(Auth::user()->check_user == 'yes')
        <li style= "padding-left:20px; padding-right:20px;"><a href="admin_panel" style="color:#FEC50D;">Admin Panel</a></li>
        @endif
        <li style= "padding-left:20px; padding-right:20px;"><a href="logout" style="color:#FEC50D;">Logout</a></li>
    </ul>
    
</li>

@else
<li>
    <a class="dropdown-toggle" data-hover="dropdown" data-delay="1000" style="background-color:#222222;color:#fff" href="javascript:void(0)" role="button" aria-expanded="false">Sign In</a>
    <ul class="dropdown-menu" style="background-color:#222222; width:285px; height:0px">
        <li>
            <div class="panel panel-info">

                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                    <div style="float:right;font-color:red; font-size: 80%; position: relative; top:-10px;"><a href="#forgotPassword" data-toggle="modal" style="color:chocolate;">Forgot password?</a></div>
                </div>     

                <div style="padding-top:20px; background:cadetblue;" class="panel-body" >
                    
                    <div style="margin-bottom: 10px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" autocomplete="off" style="color:#DAC203" class="form-control" name="user_name" value="" placeholder="Username">
                    </div>
                    
                    <div style="margin-bottom: 10px;" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" style="color:#DAC203" class="form-control" name="password" placeholder="Password">
                    </div>
                    
                    <div class="input-group">
                        <div class="row">
                            <div class="checkbox col-md-9">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                            </div>

                            <div class="col-md-3 controls">
                                <input id="btnLogin" class="btn btn-success" style="width:70px;" value="Log In">
                            </div>
                        </div>
                    </div>

                    <span id="lblError" class="col-md-12 label label-danger"></span>

                    <div style="font-size:85%">
                        <hr style="bg-color:#6621">
                        <span>Don't have an account!</span>
                        <a style="color:#FED136;" href="signup">Sign Up Here</a>
                    </div>    

                </div>                     
            </div>
        </li>
    </ul>
</li>
@endif
