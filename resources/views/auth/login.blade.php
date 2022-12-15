@extends('layouts.app')
@section('content')
@error('message')
<div class="container">
    <div class="alert alert-danger mt-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li>{{ $message }}</li>

        </ul>

    </div>
</div>
@enderror
<section class="loginSec">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
					<button type="button" id="openBoxBtnError" class="btn mt-2 btn-primary d-none ">Resend Email</button>
                </div>
                @endif
                @if (session()->has('success') || session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{session('success') ?? session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
						<button type="button" id="openBoxBtn" class="btn mt-2 btn-primary ">Resend Email</button>
               
				 </div>
				
                @endif
				
            </div>
			<div class="col-md-4 mr-5 p-5 card d-none" id="resendEmailForm">
                <form class="form-signin" method="POST" action="{{ route('register.resendActivationEmail') }}">
					@csrf
					<input id="email" type="hidden" name="email" value=" {{old('email') ?? (session('email') ?? session('email'))}}" >
					<div class="form-group row">
						<div class="col-md-12"></div>
						<div class="col-md-12">
							<div class="captcha">
								<p class="text-muted mb-0">Please solve the math problem</p>
								<span>{!! captcha_img() !!}</span>
								<button type="button" class="btn btn-danger" class="reload" id="reload">
									&#x21bb;
								</button>
							</div>
							@error('captcha')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-12"></div>
						<div class="col-md-12">
							<input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"
								required>
						</div>
					</div>
					<div class="form-group ">
						<button type="submit" class="btn btn btn-primary btn-block">Resend Email</button>
						<button type="button" id="cancelResendEmail" class="btn btn btn-secondary btn-block">Cancel</button>
					</div>
				</form>
			</div>
            <div class="col-md-4 p-5 card">
                <form class="form-signin" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class=" h3 mb-3 font-weight-normal">Please sign in</h1>
                    <p class="text-danger"><small>
                            *Please note that this training system works best on Google Chrome Browser.
                            Click
                            here to download the newest version of
                            <a target="_blank" class="text-danger" href="https://www.google.com/chrome/."><u>Chrome</u></a>.
                        </small></p>
                    <div class="form-group ">
                        <label for="email">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $emessage }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="checkbox mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <a href="/passwordreset">Forget Password?</a>

                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                    </div>
                </form>

                <a href="/register" class="btn  btn-lg btn-outline-dark w-100">Create a new account</a>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
 @if ($errors->any())
<script>
	$("#resendEmailForm").removeClass('d-none');
	//$("#openBoxBtnError").addClass('d-none');
</script>
@endif
<script>
	$("#cancelResendEmail").click(function(){
		$("#resendEmailForm").addClass('d-none');
	});
	$("#openBoxBtn").click(function(){
		$("#resendEmailForm").removeClass('d-none');
	});
	
	 $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection
