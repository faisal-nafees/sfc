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
      <form method="POST" action="/admin/agreements">
        @csrf
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="active">Class</label>
              <select name="category_id" id="category_id" class="form-control">
                <option value="">All</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ @$request->category_id == $category->id ? 'Selected' : '' }}>
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
          {{-- <div class="col-md-3">
            <div class="form-group">
              <label for="active">Lesson</label>
              <select name="subcategory_id" id="subcategory_id" class="form-control">
                <option value="">All</option>
                @foreach ($subcategories->where('category_id', $category->id) as $subcategory)
                  <option value="{{ $subcategory->id }}"
                    {{ @$request->subcategory_id == $subcategory->id ? 'Selected' : '' }}>
                    {{ $subcategory->title }}</option>
                @endforeach
              </select>
              @error('subcategory_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> --}}
          <div class="col-md-5">
            <div class="form-group">
              <label for="active">User <span class="text-danger">*</span> </label>
              {{-- <input type="text" name="user_id" id="user_id" class="form-control" required> --}}
              <select name="user_id" id="user_id" required>
                <option value="">Select a user</option>
                @foreach ($users as $u)
                  <option value="{{ $u->id }}" {{ @$request->user_id == $u->id ? 'Selected' : '' }}>
                    {{ $u->fname }} :{{ strtolower($u->email) }}
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
          <div class="col-md-2 pt-1">
            <button type="submit" class="btn btn-block btn-primary mt-4"> <i class="fas fa-search"></i>
              Search</button>
          </div>
        </div>
      </form>
      @php
        if (@$request->user_id) {
            $user = $users->where('id', $request->user_id)->first();
        }
        if (@$user) {
            if (@$request->category_id) {
                $user_categories = $user->categories->where('id', $request->category_id);
            } else {
                $user_categories = $user->categories;
            }
        }
      @endphp

      @if (@$user && @$user_categories)
        @foreach ($user_categories as $category)
          <div class="accordion" id="accordionExample{{ $category->id }}">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                    data-target="#collapse{{ $category->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                    aria-controls="collapse{{ $category->id }}">
                    {{ $category->title }} <h5 class="float-right text-info">
                      {{ $user->slideProgress->where('category_id', $category->id)->whereNotNull('agreement')->count() }}
                      Accepted
                    </h5>
                  </button>
                </h2>
              </div>

              <div id="collapse{{ $category->id }}" class="collapse {{ $loop->first ? 'show' : '' }}"
                aria-labelledby="headingOne" data-parent="#accordionExample{{ $category->id }}">
                <div class="card-body">
                  <div class="row">
                    @foreach ($category->subcategories as $subcat)
                      @php
                        $agreement = @$user->slideProgress
                            ->where('slide_id', @$subcat->slide->id)
                            ->whereNotNull('agreement')
                            ->first()->agreement;
                      @endphp
                      <div class="col-12">
                        {{ $subcat->title }}
                        <p class="float-right">
                          <span class="text-{{ $agreement ? 'success' : 'warning' }}">
                            <span>{{ @$agreement->date ?? 'N/A' }} | {{ @$agreement->name ?? 'N/A' }}</span>
                            {{-- <span  href="#"
                              onclick="showAgreement('{{ @$agreement->date ?? null }}','{{ @$agreement->name ?? null }}')"
                              class="btn btn-{{ $agreement ? 'info' : 'warning' }} rounded-circle"><i
                                class="fa fa-{{ $agreement ? 'info' : 'exclamation' }} px-1"
                                aria-hidden="true"></i></span> --}}
                          </span>
                        </p>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <h4 class="text-center mx-auto">No result found!</h4>
      @endif

    </div>
  </div>

  <!-- Modal -->
  {{-- <div class="modal fade" id="agreementInfo" tabindex="-1" aria-labelledby="agreementInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="agreementInfoLabel">Agreement Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Date</h5>
          <p class="date"></p>
          <h5>Name</h5>
          <p class="name"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}
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

    // function showAgreement(date, name) {
    //   if (date || name) {
    //     $('#agreementInfo').modal('show').find('.name').text(name);
    //     $('#agreementInfo').find('.date').text(date);
    //   }
    // }
  </script>
@endsection
