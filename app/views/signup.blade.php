@extends('common')

@section('body')

<div class="container">    

    <div style="margin-top:15%;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
            </div> 

            <div class="panel-body" style="padding:30px;">
                <form method="POST" action="create_new_user" class="form-horizontal" role="form">

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" style="color:#DAC203" class="form-control" name="first_name" placeholder="First Name" >
                            @if($errors->has('first_name'))
                            @foreach($errors->get('first_name') as $e)
                            <span class="label label-danger">{{$e}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" style="color:#DAC203" class="form-control" name="last_name" placeholder="Last Name">
                            @if($errors->has('last_name'))
                            @foreach($errors->get('last_name') as $e)
                            <span class="label label-danger">{{$e}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text"style="color:#DAC203" class="form-control" name="user_name" placeholder="User Name">
                            @if($errors->has('user_name'))
                            @foreach($errors->get('user_name') as $e)
                            <span class="label label-danger">{{$e}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" style="color:#DAC203" class="form-control" name="password" placeholder="Password">
                            @if($errors->has('password'))
                            @foreach($errors->get('password') as $e)
                            <span class="label label-danger">{{$e}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="email"style="color:#DAC203" class="form-control" name="email" placeholder="Email Address">
                            @if($errors->has('email'))
                            @foreach($errors->get('email') as $e)
                            <span class="label label-danger">{{$e}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="tel" style="color:#DAC203" class="form-control" name="contact" placeholder="Phone Number">
                            @if($errors->has('contact'))
                            @foreach($errors->get('contact') as $e)
                            <span class="label label-danger">{{$e}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <button style="margin-top:15px;" type="submit" class="form-control btn btn-success">Sign Up</button> 

                </form>
            </div>
        </div>      
    </div> 

</div>

@endsection

