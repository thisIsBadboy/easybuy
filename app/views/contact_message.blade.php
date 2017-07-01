@extends('common')

@section('body')
<div class="container">
	<div class="row" style="margin-bottom:5%;">
		<h2 class="title text-center">Reviews</h2>
		<div class="tab-pane fade active in" id="reviews" >
		@for($i=0; $i<$msgCnt; $i++)
			<div class="col-sm-12" style="margin-bottom:20px;">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>{{$msg[$i]->name}}</a></li>
					<li><a href="">Email :</i>{{$msg[$i]->email}}</a></li>
				</ul>
				<p>{{$msg[$i]->message}}</p>
			</div>
		@endfor
		</div>
	</div>
</div>
@endsection