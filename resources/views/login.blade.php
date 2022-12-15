@extends('layout')
@section('content')
<section class="loginSec">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 p-5 card">
                <form class="form-signin">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <a href="AdminDashboard" class="btn btn-lg btn-primary btn-block">Sign in</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
