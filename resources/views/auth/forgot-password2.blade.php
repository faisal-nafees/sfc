@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('password.email') }}" id="form">
    @csrf
    <input id="email" type="email" name="email" value="{{ $user->email }}">
</form>

@endsection

@section('finalScript')
<script>
    //$("#form").submit();
</script>
@endsection