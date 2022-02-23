@extends('layouts.app')

@section('content')
<div class="login">
	<div class="wrapper wrapper-login">

		<div class="container container-login animated fadeIn">

			<h3 class="text-center">Sign In To Admin</h3>

            @if($errors->any())
            <h6 class="text-danger mt-2 pb-2">{{$errors->first()}}</h6>
          @endif
			<div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" class="form-control input-border-bottom @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" required autocomplete="username"
                    autofocus >
					<label for="username" class="placeholder">Username</label>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
					<label for="password" class="placeholder">Password</label>
					<div class="show-password">
						<i class="flaticon-interface"></i>
					</div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
						<label class="custom-control-label" for="rememberme">Remember Me</label>
					</div>

					<a href="#" class="link float-right">Forget Password ?</a>
				</div>
				<div class="form-action mt-2">
					<button type="submit" class="btn btn-primary btn-rounded btn-login py-2" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Sign In</button>
				</div>
            </form>
				{{-- <div class="login-account">
					<span class="msg">Don't have an account yet ?</span>
					<a href="#" id="show-signup" class="link">Sign Up</a>
				</div> --}}
			</div>
		</div>


	</div>

</div>




@endsection
