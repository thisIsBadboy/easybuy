@extends('common')

@section('body')

<div class="container"> 
    <div class="row">   

      <div style="margin-top:0%; margin-bottom:5%" class="col-md-9 col-md-offset-2 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info">    
                <div class="panel-body">

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Name</label>
                        <div class="col-md-7">
                            <input value="{{Auth::user()->first_name}}{{" "}}{{Auth::user()->last_name}}" class="form-control" type="text" readonly>&nbsp;
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default" data-toggle="modal" data-target="#myModalForName">Change</button>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top:5%">
                        <label for="firstname" class="col-md-3 control-label">User Name</label>
                        <div class="col-md-7">
                            <input value="{{Auth::user()->user_name}}" class="form-control" type="text" readonly>&nbsp;
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default" data-toggle="modal" data-target="#myModalForUsername">Change</button>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top:5%">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-7">
                            <input value="{{Auth::user()->email}}" class="form-control" type="text" readonly>&nbsp;
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default" data-toggle="modal" data-target="#myModalForEmail">Change</button>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top:5%">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-7">
                            <input value="**********" class="form-control" type="text" readonly>&nbsp;
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default" data-toggle="modal" data-target="#myModalForPassword">Change</button>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top:5%">
                        <label for="Phone Number" class="col-md-3 control-label">Phone Number</label>
                        <div class="col-md-7">
                            <input value="{{Auth::user()->contact}}" class="form-control" type="text" readonly="">&nbsp;
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default" data-toggle="modal" data-target="#myModalForPhone">Change</button>
                        </div>
                    </div>

                </div>                     
            </div>  
        </div> 
    </div>       
</div>
@endsection