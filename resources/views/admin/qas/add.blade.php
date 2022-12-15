@extends('admin/layout')

@section('head')
<style>
    #imageShow{
        position: relative;
        height: 210px;
        max-width: 350px;
    }
    #imageShow img, #imageShow a{
        position: absolute;
        border-radius: 5px;
    }
    #imageShow a  {
        right: 1rem;
        top: 1rem;
        padding:.6rem .8rem;
        background-color:rgb(230, 73, 73);
        border-radius:50%;
        box-shadow: 0 0 10 rgba(128, 128, 128, 0.459);
        color:white !important;
    }
    #imageShow img{
        height: 100%;
    }
    </style>
@endsection

@section('content')
<li class="breadcrumb-item active" aria-current="page"><a href="/admin/qas/cat">Q&A</a></li>
<li class="breadcrumb-item active" aria-current="page">Add</li>
</ol>
</nav>
<div class="row d-flex justify-content-center mt-5">
    @if (Session::has('message'))
    <div class="alert alert-success col-10 p-3 mt-3">
        <ul>
            <li>{{ Session::get('message') }}</li>
        </ul>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger col-10 p-3 mt-3">
        <ul>
            <li>{{ Session::get('error') }}</li>
        </ul>
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-md-10 card p-5">
        <form method="POST" action="/admin/qas/store" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Class</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option>Select an option</option>
                            @foreach ($categories as $category)
                            <option @if(old("category_id")==$category->id) {{ "selected" }} @endif
                                value="{{ $category->id }}">{{ $category->title }}</option>
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
                        <label for="subcategory_id">Lesson</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                            <option>Select an option</option>
                            @foreach ($subcategories as $subcategory)
                            <option @if(old("subcategory_id")==$subcategory->id) {{ "selected" }} @endif
                                value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="multi_choice">Multiple Choice</label>
                        <select name="multi_choice" id="multi_choice" onchange="multiChoice(this)" class="form-control"
                            required>
                            <option @if(old("multi_choice")=="Y" ) {{ "selected" }} @endif value="Y">Yes</option>
                            <option @if(old("multi_choice")=="Y" ) {{ "selected" }} @endif value="N">No</option>
                        </select>
                        @error('multi_choice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input id="question" type="text" class="form-control @error('question') is-invalid @enderror"
                            name="question" value="{{ old('question') }}" required autocomplete="question" autofocus>
                        @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input id="image" onchange="readURL(this)" type="file" class="form-control-file @error('image') is-invalid @enderror"
                            name="image" value="" autocomplete="image" autofocus>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="option1">Option 1</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option1">
                                </div>
                            </div>
                            <input id="option1" type="text"
                                class="form-control option @error('option1') is-invalid @enderror" name="option1"
                                value="{{ old('option1') }}" required autocomplete="option1" autofocus>
                            @error('option1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="option2">Option 2</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option2">
                                </div>
                            </div>
                            <input id="option2" type="text" onkeyup="showNxtAns(this)"
                                class="form-control option @error('option2') is-invalid @enderror" name="option2"
                                value="{{ old('option2') }}" required autocomplete="option2" autofocus>
                            @error('option2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none">
                    <div class="form-group">
                        <label for="option3">Option 3</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option3">
                                </div>
                            </div>
                            <input id="option3" type="text" onkeyup="showNxtAns(this)"
                                class="form-control option @error('option3') is-invalid @enderror" name="option3"
                                value="{{ old('option3') }}" autocomplete="option3" autofocus>
                            @error('option3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none">
                    <div class="form-group">
                        <label for="option4">Option 4</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option4">
                                </div>
                            </div>
                            <input id="option4" type="text" onkeyup="showNxtAns(this)"
                                class="form-control option @error('option4') is-invalid @enderror" name="option4"
                                value="{{ old('option4') }}" autocomplete="option4" autofocus>
                            @error('option4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none">
                    <div class="form-group">
                        <label for="option1">Option 5</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option5">
                                </div>
                            </div>
                            <input id="option5" type="text" onkeyup="showNxtAns(this)"
                                class="form-control option @error('option5') is-invalid @enderror" name="option5"
                                value="{{ old('option5') }}" autocomplete="option5" autofocus>
                            @error('option5')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none">
                    <div class="form-group">
                        <label for="option2">Option 6</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option6">
                                </div>
                            </div>
                            <input id="option6" type="text" onkeyup="showNxtAns(this)"
                                class="form-control option @error('option6') is-invalid @enderror" name="option6"
                                value="{{ old('option6') }}" autocomplete="option6" autofocus>
                            @error('option6')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none">
                    <div class="form-group">
                        <label for="option3">Option 7</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option7">
                                </div>
                            </div>
                            <input id="option7" type="text" onkeyup="showNxtAns(this)"
                                class="form-control option @error('option7') is-invalid @enderror" name="option7"
                                value="{{ old('option7') }}" autocomplete="option7" autofocus>
                            @error('option7')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-none">
                    <div class="form-group">
                        <label for="option4">Option 8</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="answer" onchange="inputGreen(this)" name="answer[]"
                                        value="option8">
                                </div>
                            </div>
                            <input id="option8" type="text"
                                class="form-control option @error('option8') is-invalid @enderror" name="option8"
                                value="{{ old('option8') }}" autocomplete="option8" autofocus>
                            @error('option8')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
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

@section('finalScript')
<script>

/* -------------------------------------------------------------------------- */
/*                             //Global Variables                             */
/* -------------------------------------------------------------------------- */

$subcategories = @json($subcategories);

/* -------------------------------------------------------------------------- */



/* ------------------------ Auto add new answer field ----------------------- */
function showNxtAns(e){
    if($(e).val() == ""){
        $(e).parent().parent().parent().next().addClass('d-none');
    }else{
        $(e).parent().parent().parent().next().removeClass('d-none');
    }
}
/* -------------------------------------------------------------------------- */


/* --------------------- Selected right answers to green -------------------- */
function inputGreen(e){
    if($('#multi_choice').val() == "Y"){
        if($(e).is(':checked')){
            $('#'+e.value).addClass("is-valid");
        }else{
            $('#'+e.value).removeClass("is-valid");
        }
    }else{
        $(".option").each(function() {
            if($(this).hasClass("is-valid")){
                $(this).removeClass("is-valid")
            }
        });
        $('#'+e.value).addClass("is-valid");
    }
}
/* -------------------------------------------------------------------------- */


/* ---------------- Change input-type on Multi Choice change ---------------- */
function multiChoice(e){
    if($(e).val() === 'Y'){
        $('.answer').attr('type', 'checkbox');
    }else{
        $('.answer').attr('type', 'radio');
    }
    $('.answer').prop('checked', false);
    $('.option').removeClass("is-valid")
}
/* -------------------------------------------------------------------------- */


/* -------------------------- //On Category select -------------------------- */
$('#category_id').change( function(e){
    $oldVal = {{ old("subcategory_id", 0) }};

    $('#subcategory_id').html(``);
    $('#subcategory_id').append(`<option >Select an option</option>`);
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


/* -------------------------- //Show Image to upload ------------------------ */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(input).before(`
            <div id="imageShow">
                <img class="img-fluid" src="`+ e.target.result +`" style="width: 400px; height:200px;">
                <a onclick="rmImg(this)" href="javascript:void(0)" >
                    <i class="fas fa-trash"></i>
                </a>
            </div>`);
            $(input).toggle();

        }
        reader.readAsDataURL(input.files[0]);
    }
}

function rmImg(e){
    $(e).parent().remove();
    $('#image').val('');
    $('#image').toggle();
}
/* -------------------------------------------------------------------------- */

</script>
@endsection
