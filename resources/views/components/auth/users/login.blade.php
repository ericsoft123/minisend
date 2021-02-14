@extends('layouts.app')
@section('content')

<div class="limiter">


		<div class="container-login100" style="background-image: url('loginfolder/images/cam1.jpg');">
			<div class="wrap-login100 mywrap-login p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form otp_append" method="POST" action="{{ route('login') }}" >
				{{ csrf_field() }}
				<div class="divotp_append">
				<div class="img-center">
				
				<div class="circle-frame circle_image_user"></div>
					</div>
				<a href="index.html"><span style="visibility:hidden">Back Home</span></a><span class="login100-form-title p-b-49">
					Login
				</span>
				<!--test-->
			
				<!--test-->

				@if (\Session::has('errors'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong></strong>{!! \Session::get('errors') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
					@if (\Session::has('status'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong></strong>{!! \Session::get('status') !!} 	
	@if (\Session::has('encryptdata'))

						<input class="input100" type="hidden" name="email" placeholder="Email or Phone" value="{{\Session::get('encryptdata')}}">
					
					<a href="#" onclick="resend_email('{{\Session::get('encryptdata')}}')"></a>
					


                    @endif
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">

	
	<span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
						<span class="label-input100">Email or Phone</span>
						<input class="input100" type="text" name="email" placeholder="Email or Phone" required>
						<span class="focus-input100" data-symbol="&#xf15a;"></span>
					
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Type your password" required>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>


					
					
                    <div class="text-right p-t-8 p-b-31" style="color:blue">
						
					</div>
					<div class="text-right  p-b-3" >
						<a href="forgetpage" style="color:blue">
						Forget Password
						</a>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
                    <div class="text-right p-t-8 p-b-31" >
						<a href="registerpage" style="color:blue">
						Create Account
						</a>
					</div>

					
					</div>
				
				</form>
			</div>
		</div>
	</div>
	
@endsection