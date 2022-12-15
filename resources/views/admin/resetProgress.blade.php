@extends('admin/layout')

@section('head')
<link href="/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<li class="breadcrumb-item">Reset Progress</li>
</ol>
</nav>

<div class="row d-flex justify-content-center mt-5">

    <div class="d-flex justify-content-center col-12">
        @if (Session::has('message'))
        <div class="alert alert-success col-10 mx-3">
            <ul class="mb-0">
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger col-10  ml-2">
            <ul>
                <li>{{ Session::get('error') }}</li>
            </ul>
        </div>
        @endif
    </div>
    <div class="col-md-6 card p-5">
        <form method="POST" action="/admin/reset_progress">
            @csrf
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">Class</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                        <label for="active">Lesson</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                            <option value="">All</option>
                        </select>
                        @error('subcategory_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="active">User <span class="text-danger">*</span> </label>
                        {{-- <input type="text" name="user_id" id="user_id" class="form-control" required> --}}
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Select a user</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->fname }} :{{ $user->email }}
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Reset Progress</button>
        </form>
    </div>
</div>
@endsection


@section('finalScript')
<script src="/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
    $('#user_id').select2();
    $('.select2-selection.select2-selection--single').css({"padding": ".4rem",
    "height": "2.4rem",
    })
    $('.select2.select2-container').css({
    "width": "100%"
    })
});
    /* -------------------------------------------------------------------------- */
    /*                             //Global Variables                             */
    /* -------------------------------------------------------------------------- */

    $subcategories  = @json($subcategories);
    $users          = @json($users);

    /* -------------------------------------------------------------------------- */


    /* -------------------------- //On Category select -------------------------- */
    $('#category_id').change( function(e){
        $oldVal = {{ old("subcategory_id", 0) }};

        $('#subcategory_id').html(``);
        $('#subcategory_id').append(`<option value="" >ALL</option>`);
        $.each($subcategories, function(index, $subcategory) {
            if($subcategory.slide == null && $subcategory.category_id == $('#category_id').val()){
                if($oldVal){
                    $('#subcategory_id').append(`
                        <option`+
                        $oldVal == $subcategory.id ? "selected"  : "" +
                        `value="` + $subcategory.id + `">` + $subcategory.title + `</option>
                    `);
                }else{
                    $('#subcategory_id').append(`
                        <option value="` + $subcategory.id + `">` + $subcategory.title + `</option>
                    `);
                }
            }
        });
    });
    /* -------------------------------------------------------------------------- */

    /* -------------------------- //On user search -------------------------- */
    // $('#user_id').change( function(e){
    //     $users.forEach(function ($user){
    //         if( $user['email'].includes($(e).value) ){
    //             $(e).after(`
    //             <div class="bordered rounded">
    //                 <h5>`+$user['fname']+` `+$user['lname']`</h5>
    //                 <h4 class="text-success">`+$user['email']`</h4>
    //             </div>
    //             `)
    //         }
    //     })
    // });
    /* -------------------------------------------------------------------------- */

</script>
@endsection
