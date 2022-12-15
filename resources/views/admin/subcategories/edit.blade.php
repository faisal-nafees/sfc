@extends('admin/layout')
@section('content')
<li class="breadcrumb-item active" aria-current="page"><a href="/admin/subcategory/index/{{ $subcategory->category_id }}">Lessons</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
</ol>
</nav>
<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6 card p-5">
        <form method="POST" action="/admin/subcategory/update/{{ $subcategory->id }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title', $subcategory->title) }}" required autocomplete="title" autofocus>
                        <div class="invalid-feedback">
                            Please enter a title!
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Parent Class</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option @if($subcategory->category->id == $category->id ) {{ 'selected' }} @endif value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                          </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Active</label>
                        <select name="active" class="form-control @error('active') {{ "is-invalid" }} @enderror">
                            <option @if(old("active") == "Y") {{ "selected" }} @elseif(old("active") == "" && $subcategory->active == "Y") {{ "selected" }} @endif value="Y">Yes</option>
                            <option @if(old("active") == "N") {{ "selected" }} @elseif(old("active") == "" && $subcategory->active == "N") {{ "selected" }} @endif value="N">No</option>
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
