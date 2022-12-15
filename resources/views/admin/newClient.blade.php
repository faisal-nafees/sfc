@extends('admin/layout')
@section('content')
<li class="breadcrumb-item active" aria-current="page">Add New Client</li>
</ol>
</nav>

<div class="row d-flex justify-content-center mt-5">
    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all()  as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session()->has('success') || session()->has('message'))
        <div class="alert alert-success mt-3">
            {{session('success') ?? session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>

<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6 card p-5">

        <form method="POST" action="/admin/Add-New-Client">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                            name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>
                        @error('fname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                            name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>
                        @error('lname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @foreach($categories as $category)

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="categories{{$category->id}}" name="categories[]"
                            value="{{$category->id}}">
                        <label class="form-check-label" for="categories{{$category->id}}">{{$category->title}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection
