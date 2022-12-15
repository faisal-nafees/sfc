@extends('admin/layout')

@section('head')
    <style>
        .alert {
            max-width: 99% !important;
        }
    </style>
@endsection

@section('content')
    <li class="breadcrumb-item active" aria-current="page">Slides</li>
    </ol>
    </nav>
    <!-- Floating CTA Button Start -->
    <a href="/admin/slides/create" class="float d-flex justify-content-center align-items-center"><span><i
                class="fas fa-plus feather fa-2x"></i></span>
    </a>
    <!-- Floating CTA Button End -->
    <div class="row m-1">
        @if (Session::has('message'))
            <div class="alert alert-success col-12 mx-3">
                <ul class="mb-0">
                    <li>{{ Session::get('message') }}</li>
                </ul>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger col-12  ml-2">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
        @endif
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    @if (@$showCat)
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Classes</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>


                                    <td>
                                        <a href="/admin/slides/subcategory/{{ $category->id }}"
                                            class="btn btn-outline-primary delete float-right">
                                            View Lessons <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @elseif (@$showSubcat)
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Lessons</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->title }}</td>
                                    <td>
                                        <a href="/admin/slides/index/{{ $subcategory->id }}"
                                            class="btn btn-outline-primary delete float-right">
                                            View Slides <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Created Date</th>
                                <th scope="col">Classes</th>
                                <th scope="col">Lessons</th>
                                <th scope="col">Slide</th>

                                <th scope="col">Active</th>
                                <th scope="col">Copy Slides</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slides as $slide)
                                <tr>
                                    <td>{{ @$slide->created_at }}</td>
                                    <td>{{ @$slide->category->title }}</td>
                                    <td>{{ @$slide->subcategory->title }}</td>
                                    <td>{{ @$slide->subcategory->title }} Slide</td>
                                    <td>
                                        @if (@$slide->active == 'Y')
                                            {!! '<div class="badge badge-success"> Yes </div>' !!}
                                        @else
                                            {!! '<div class="badge badge-danger"> No </div>' !!}
                                        @endif
                                    </td>
                                    <td>

                                        <a href="/admin/slides/copy/{{ @$slide->id }}"
                                            data-confirm="Are you sure you want to make Copy of this {{ $slide->title }}?"
                                            onClick="copyItem(this)" class="btn btn-success delete"><i
                                                class="fas fa-copy"></i></a>


                                        <form action="/admin/slides/copy/{{ @$slide->id }}" method="post"
                                            class="d-inline" id="category{{ @$slide->id }}">
                                            @csrf
                                            @method('POST')
                                        </form>
                                    </td>
                                    <td style="width:120px">
                                        <a href="/admin/slides/edit/{{ @$slide->id }}" class="btn btn-primary "><i
                                                class="far fa-edit"></i></a>
                                        <a href="#" data-confirm="Are you sure to delete this Ques&Ans?"
                                            onClick="deleteItem(this)" class="btn btn-danger delete"><i
                                                class="fas fa-trash"></i></a>


                                        <form action="/admin/slides/destroy/{{ @$slide->id }}" method="get"
                                            class="d-inline" id="destroy{{ @$slide->id }}">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                @if (@$showCat)
                    <div class="container">
                        {{ $categories->links() }}
                    </div>
                @elseif (@$showSubcat)
                    <div class="container">
                        {{ $subcategories->links() }}
                    </div>
                @else
                    <div class="container">
                        {{ $slides->links() }}
                    </div>
                @endif

                <div style="height: 50px;"></div>
            </div>
        </div>
    </div>
@endsection


@section('finalScript')
    <script>
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('searchslide') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }

            });
        })

        function deleteItem(e) {
            var choice = confirm(e.getAttribute('data-confirm'));
            if (choice) {
                document.getElementById(e.nextElementSibling.id).submit();
            }
        }

        function copyItem(e) {
            var choice = confirm(e.getAttribute('data-confirm'));
            if (choice) {
                document.getElementById(e.nextElementSibling.id).submit();
            }
        }
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
