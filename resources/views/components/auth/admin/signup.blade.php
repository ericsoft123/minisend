@extends('layouts.app')
@section('content')

<div class="limiter">
@if(session('message'))
{{ session('message') }}
@endif
		<div class="container-login100" style="background-image: url('loginfolder/images/bg-012.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST"action="{{ route('signup') }}">
						{{ csrf_field() }}
						<div class="img-center">
						<div class="circle-frame circle_image_pharmacy"></div>
						</div>	
					<a href="index.html"><span style="visibility:hidden">Back Home</span></a><span class="login100-form-title p-b-49">
						Signup
					</span>
					@if (\Session::has('errors'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Hi</strong>{!! \Session::get('errors') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
					@if (\Session::has('status'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Hi </strong>{!! \Session::get('status') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

				
              
         
					<div class="wrap-input100 validate-input m-b-23   " data-validate = "Name is required">
						<span class="label-input100">Name</span>
						<input class="input100"  type="text" name="name" value="" placeholder="Name">
						<span class="focus-input100" data-symbol="&#xf106;"></span>
						
                    </div>
                    
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
						<span class="label-input100">Email</span>
						<input class="input100"  type="email"  name="email" value="{{ old('email') }}" placeholder="Email">
						<span class="focus-input100" data-symbol="&#xf15a;"></span>
                    </div>
                    

					<div class="wrap-input100 validate-input " data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100"  id="password" type="password"  name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
						
						
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Confirmation Password is required">
						<span class="label-input100">Confirm Password</span>
						<input class="input100"id="password-confirm" type="password"  name="password_confirmation" placeholder="Confirm Password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                    

                    
					
                    <div class="text-right p-t-8 p-b-31" style="color:blue">
						
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Create Account
							</button>
						</div>
					</div>
                    <div class="text-right p-t-8 p-b-31" >
						<a href="signinpage" style="color:blue">
                            Already registered?Sign In
						</a>
					</div>

					

				
				</form>
			</div>
		</div>
	</div>
@endsection