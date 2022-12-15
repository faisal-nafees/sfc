@extends('admin/layout')
@section('content')
<li class="breadcrumb-item active" aria-current="page"><a href="/admin/category">Classes</a></li>
<li class="breadcrumb-item active" aria-current="page">Add</li>
</ol>
</nav>
<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6 card p-5">
        <form method="POST" action="/admin/category/store">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                            name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Active</label>
                        <select name="active" id="active" class="form-control" required>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                          </select>
                        @error('active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection
