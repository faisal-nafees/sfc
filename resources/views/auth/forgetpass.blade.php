@extends('layout')
@section('content')
<section class="loginSec">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12">
                @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="col-md-4 p-5 card">
                <form method="POST" action="/passwordreset" enctype="multipart/form-data">
                    @csrf
                    <h1 class="h3 mb-3 font-weight-normal">Password Change</h1>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $email ?? old('email') }}" placeholder="Email Address" required
                                autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-primary btn-block">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
