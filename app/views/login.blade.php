@extends('common')

@section('body')
<section id="form" style="margin-top:0%;"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					<form method="POST" action="login_user">
						<input name="user_name" type="text" placeholder="User Name" />
						<input name="password" type="password" placeholder="Password" />
						<span>
							<input type="checkbox" name="keep_me_sign_in" class="checkbox"> 
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Login</button>
					</form>
				</div><!--/login form-->

				@if($hasError == 'Yes')
				<div style="border: 1px solid #F0F0E9; margin-top:20px; padding-top:10px;">
						<ul class="user_option">
							
							<li style="font-weight: bold; color:rgb(171, 0, 0);">Enter valid e-mail or password!</li>
							
						</ul>
				</div>
				@endif

				@if($errors->any())
				<div style="border: 1px solid #F0F0E9; margin-top:20px; padding-top:10px;">
						<ul class="user_option">
							
							{{implode('', $errors->all('<li style="list-style:initial; line-height: 20px; font-weight: bold; color:rgb(171, 0, 0);">:message</li>'))}}
							
						</ul>
				</div>
				@endif

			</div>

			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form method="POST" action="create_new_user">
						<input type="text" name="first_name" placeholder="First Name"/>
						<input type="text" name="last_name" placeholder="Last Name"/>
						<input type="text" name="user_name" placeholder="User Name"/>
						<input type="email" name="email" placeholder="Email Address"/>
						<input type="password" name="password" placeholder="Password"/>
						<input type="text" name="contact" placeholder="Phone Number"/>
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection