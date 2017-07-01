@extends('common')

@section('body')
<div class="container">  

    <div class="row" style="text-align:center;">
        <button class="btn btn-default" data-toggle="modal" data-target="#myModalForFeedback">Give us feedback</button>
    </div>  

    <br/>

    <div class="tab-pane fade active in" id="reviews" >
    @foreach($res as $feedback)
    
        <div class="col-md-12" style="border-bottom: 1px solid gold; margin-bottom: 20px;">
            <ul>
                <li><a href=""><i class="fa fa-user"></i>{{$feedback->name}}</a></li>
                <li><a href=""><i class="fa fa-clock-o"></i>{{date_format(date_create($feedback->feedback_time), 'H:i A')}}</a></li>
                <li><a href=""><i class="fa fa-calendar-o"></i>{{date_format(date_create($feedback->feedback_time), 'd-M-Y')}}</a></li>
            </ul>
            <p>{{$feedback->feedback_text}}</p>
        </div>
    
    @endforeach
    </div>
</div>
@endsection