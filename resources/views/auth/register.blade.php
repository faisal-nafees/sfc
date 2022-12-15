@extends('layouts.app')

@section('content')
@php
// dd($errors);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session()->has('success') || session()->has('message') )
            <div class="alert alert-success mt-3">
                {{session('success') ?? session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card m-5">
                <div class="card-header">{{ __('Create an account') }}</div>
                <div class="px-4 text-center">
                    <p class="text-danger">
                        <small>
                            *Please note that this training system works best on Google Chrome Browser.<br>
                            Click here to download the newest version of
                            <a class=" text-danger" href="https://www.google.com/chrome/."><u>Chrome</u></a>.
                        </small>
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="/register">
                        @csrf

                        <div class="form-group row">
                            <label for="lname"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                                    name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname"
                                class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                                    name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Organization') }}</label>

                        <div class="col-md-6">
                            <input id="org_code" type="text" maxlength="6"
                                class="form-control @error('org_code') is-invalid @enderror" name="org_code"
                                value="{{ old('org_code') }}">

                            @error('org_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div> --}}

                <div class="form-group row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
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
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"
                            required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Sign Up') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
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
