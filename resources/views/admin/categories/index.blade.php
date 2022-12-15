@extends('admin/layout')
@section('content')
    <li class="breadcrumb-item active" aria-current="page">Classes</li>
    </ol>
    </nav>
    <!-- Floating CTA Button Start -->
    <a href="/admin/category/create" onclick="hideNav()"
        class="float d-flex justify-content-center align-items-center"><span><i class="fas fa-plus feather fa-2x"></i></span>

    </a>
    <!-- Floating CTA Button End -->
    <div class="row m-1">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Active</th>
                            <th scope="col">Copy Classes</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ @$category->title }}</td>
                                <td>{{ @$category->price }}</td>
                                <td>
                                    @if (@$category->active == 'Y')
                                        {!! '<div class="badge badge-success"> Yes </div>' !!}
                                    @else
                                        {!! '<div class="badge badge-danger"> No </div>' !!}
                                    @endif
                                </td>
                                <td>

                                    <a href="/admin/category/copy/{{ @$category->id }}"
                                        data-confirm="Are you sure you want to make Copy of this {{ $category->title }}?"
                                        onClick="copyItem(this)" class="btn btn-success delete"><i
                                            class="fas fa-copy"></i></a>


                                    <form action="/admin/category/copy/{{ @$category->id }}" method="post" class="d-inline"
                                        id="category{{ @$category->id }}">
                                        @csrf
                                        @method('POST')
                                    </form>
                                </td>
                                <td style="width:120px">
                                    <a href="/admin/category/edit/{{ @$category->id }}" class="btn btn-primary "><i
                                            class="far fa-edit"></i></a>
                                    <a href="#" data-confirm="Are you sure to delete this Category?"
                                        onClick="deleteItem(this)" class="btn btn-danger delete"><i
                                            class="fas fa-trash"></i></a>


                                    <form action="/admin/category/destroy/{{ @$category->id }}" method="post"
                                        class="d-inline" id="destroy{{ $category->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    {{ $categories->links() }}
                </div>
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
                url: '{{ URL::to('searchcategory') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                }

            });
        })

        function copyItem(e) {
            var choice = confirm(e.getAttribute('data-confirm'));
            if (choice) {
                document.getElementById(e.nextElementSibling.id).submit();
            }
        }

        function deleteItem(e) {
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
