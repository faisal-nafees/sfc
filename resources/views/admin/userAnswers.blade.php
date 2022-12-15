@extends('admin/layout')

@section('head')
  <link href="/css/select2.min.css" rel="stylesheet" />
  <style>
    .wrong-ans {
      background: rgb(241, 189, 189);
    }

    td {
      word-wrap: break-word;
    }

    .tg {
      border-collapse: collapse;
      border-spacing: 0;
    }

    .tg td {
      border-style: solid;
      border-width: 1px;
    }

    .tg th {
      padding: 10px 5px;
      border-style: solid;
      border-width: 1px;
    }

  </style>
@endsection

@section('content')
  <li class="breadcrumb-item active" aria-current="page">Client</li>
  </ol>
  </nav>

  @php
  // dd(@$qas, @$user_answers, @$user, @$categories);
  @endphp
  <div class="row m-1">
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
    <div class="col-md-12 p-3 mx-auto">
      <form method="POST" action="/admin/user_answers">
        @csrf
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="active">Class</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">All</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ @$category->id == @$cat_id ? 'Selected' : '' }}>
                    {{ $category->title }}</option>
                @endforeach
              </select>
              @error('category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="active">Lesson</label>
              <select name="subcategory_id" id="subcategory_id" class="form-control">
                <option value="">All</option>
                @foreach ($subcategories->where('category_id', $category->id) as $subcategory)
                  <option value="{{ $subcategory->id }}" {{ @$subcategory->id == @$subcat_id ? 'Selected' : '' }}>
                    {{ $subcategory->title }}</option>
                @endforeach
              </select>
              @error('subcategory_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="active">User <span class="text-danger">*</span> </label>
              {{-- <input type="text" name="user_id" id="user_id" class="form-control" required> --}}
              <select name="user_id" id="user_id" required>
                <option value="">Select a user</option>
                @foreach ($users as $u)
                  <option value="{{ $u->id }}" {{ @$user->id == $u->id ? 'Selected' : '' }}>
                    {{ $u->fname }} :{{ $u->email }}
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
          <div class="col-md-3 pt-1">
            <button type="submit" class="btn btn-block btn-primary mt-4"> <i class="fas fa-search"></i>
              Search</button>
          </div>
        </div>
      </form>
    </div>
    @if (@$user_answers)
      @if (@$user_answers->count() != 0)
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table" style="table-layout: fixed; width: 100%">
              <thead class="thead-dark">
                <colgroup>
                  <col style="width: 150px">
                  <col style="width: 200px">
                  <col style="width: 100px">
                  <col style="width: 100px">
                </colgroup>
                <tr style="background: #353A40 ; color: white">
                  <th colspan="4">
                    <p class="d-block d-md-inline">
                      <b>NAME: </b>{{ @$user->fname . ' ' . @$user->lname }}<br>
                      <b>EMAIL: </b>{{ @$user->email }}
                    </p>
                    <button onclick="sortWrongAnswers()" class="btn btn-secondary float-left float-md-right">
                      <i class="fas fa-filter"></i> Sort Wrong First
                    </button>
                  </th>
                </tr>
                <tr style="background: #353A40 ; color: white">
                  <th scope="col">CLASS & LESSON</th>
                  <th scope="col" style="width: 500px">QUESTION</th>
                  <th scope="col">USER ANSWER</th>
                  <th scope="col">RIGHT ANSWER</th>
                </tr>
              </thead>
              <tbody id="table-body">
                @foreach (@$user_answers as $user_answer)
                  @php
                    $qa = $qas->where('id', $user_answer->qa_id)->first();
                  @endphp
                  <tr {!! @$user_answer->answers != @$qa->answer ? "class='wrong-ans'" : '' !!}>
                    <td>
                      <b>Class:</b> {{ @$qa->category->title }}<br>
                      <b>Lesson:</b> {{ @$qa->subcategory->title }}
                    </td>
                    <td style="width: 50%;">
                      {{ @$qa->question }}
                    </td>
                    <td>{{ @$user_answer->answers }}</td>
                    <td>{{ @$qa->answer }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @else
        <h4 class="text-center mx-auto">No result found!</h4>
      @endif
    @endif
  </div>
@endsection


@section('finalScript')
  <script src="/js/select2.full.min.js"></script>
  <script>
    //     $.ajaxSetup({
    // 	headers: {
    // 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // 	}
    // });
    $(document).ready(function() {
      $('#user_id').select2();
      $('.select2-selection.select2-selection--single').css({
        "padding": ".4rem",
        "height": "2.4rem",
      })
      $('.select2.select2-container').css({
        "width": "100%"
      })
    });
    /* -------------------------------------------------------------------------- */
    /*                             //Global Variables                             */
    /* -------------------------------------------------------------------------- */
    $subcategories = @json($subcategories);
    $users = @json($users);
    /* -------------------------------------------------------------------------- */


    /* -------------------------- //On Category select -------------------------- */
    $('#category_id').change(function(e) {
      $oldVal = {{ old('subcategory_id', 0) }};

      $('#subcategory_id').html(``);
      $('#subcategory_id').append(`<option value="" >ALL</option>`);
      $.each($subcategories, function(index, $subcategory) {
        if ($subcategory.slide == null && $subcategory.category_id == $('#category_id').val()) {
          if ($oldVal) {
            $('#subcategory_id').append(`
                        <option` +
              $oldVal == $subcategory.id ? "selected" : "" +
              `value="` + $subcategory.id + `">` + $subcategory.title + `</option>
                    `);
          } else {
            $('#subcategory_id').append(`
                        <option value="` + $subcategory.id + `">` + $subcategory.title + `</option>
                    `);
          }
        }
      });
    });
    /* -------------------------------------------------------------------------- */
    function sortWrongAnswers() {
      $('.wrong-ans').each(function() {
        $('#table-body').prepend($(this)[0].outerHTML)
        $(this).remove()
      })

    }
  </script>
@endsection
