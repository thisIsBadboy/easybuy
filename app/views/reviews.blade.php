@extends('common')

@section('body')
<div class="container">
	<div class="row" style="margin-bottom:5%;">
		<h2 class="title text-center">Reviews</h2>
		<div class="tab-pane fade active in" id="reviews" >
		@for($i=0; $i<$reviewCnt; $i++)
			<div class="col-sm-12" style="margin-bottom:20px;">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>{{$review[$i]->name}}</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>{{date_format(date_create($review[$i]->review_time), 'H:i A')}}</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>{{date_format(date_create($review[$i]->review_time), 'd-M-Y')}}</a></li>
				</ul>
				<p>{{$review[$i]->review_text}}</p>
			</div>
		@endfor
		</div>
	</div>
</div>
@endsection