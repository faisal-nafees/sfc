@extends('admin/layout')
@section('content')
<li class="breadcrumb-item active" aria-current="page"><a href="/admin/category">Classes</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
</ol>
</nav>
<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6 card p-5">
        <form method="POST" action="/admin/category/update/{{ $category->id }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title', $category->title) }}" required autocomplete="title" autofocus>
                        <div class="invalid-feedback">
                            Please enter a title!
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                            name="price" value="{{ old('price', $category->price) }}" required autocomplete="price" autofocus>
                        <div class="invalid-feedback">
                            Please enter a price!
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Active</label>
                        <select name="active" class="form-control @error('active') {{ "is-invalid" }} @enderror">
                            <option @if(old("active") == "Y") {{ "selected" }} @elseif(old("active") == "" && $category->active == "Y") {{ "selected" }} @endif value="Y">Yes</option>
                            <option @if(old("active") == "N") {{ "selected" }} @elseif(old("active") == "" && $category->active == "N") {{ "selected" }} @endif value="N">No</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select an option!
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection
