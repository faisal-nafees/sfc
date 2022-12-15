@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('status'))
            @if (session('status') == "We have emailed your password reset link!")
            <script>
                window.location.replace("/Add-New-Client");
            </script>
            @else
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @else
            <h3 class="pt-5">Sending email to {{ session()->get('email') }} ....</h3>
            @endif

            <form method="POST" action="/send-activate-acc-email" id="form">
                @csrf
                <input id="email" type="hidden" name="email" value="{{ session()->get('email') }}">
            </form>
        </div>
    </div>
    @endsection

    @section('finalScript')
    @if (!session('status'))
    <script>
        $('#form').submit();
    </script>
    @endif
    @endsection
