@extends('admin/layout')
@section('content')
<li class="breadcrumb-item active" aria-current="page">Lessons</li>
</ol>
</nav>
<!-- Floating CTA Button Start -->
<a href="/admin/subcategory/create" onclick="hideNav()"
    class="float d-flex justify-content-center align-items-center"><span><i
            class="fas fa-plus feather fa-2x"></i></span>
</a>
<!-- Floating CTA Button End -->
<div class="row m-1">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table">
                @if (@$showSubcat)
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Parent Class</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $subcategory)

                    <tr>
                        <td>{{@$subcategory->title}}</td>
                        <td>{{@$subcategory->category->title}}</td>
                        <td>
                            @if(@$subcategory->active == "Y")
                            {!! '<div class="badge badge-success"> Yes </div>' !!}
                            @else
                            {!! '<div class="badge badge-danger"> No </div>' !!}
                            @endif
                        </td>
                        <td style="width:120px">
                            <a href="/admin/subcategory/edit/{{@$subcategory->id}}" class="btn btn-primary "><i
                                    class="far fa-edit"></i></a>
                            <a href="#" data-confirm="Are you sure to delete this Subcategory?"
                                onClick="deleteItem(this)" class="btn btn-danger delete"><i
                                    class="fas fa-trash"></i></a>


                            <form action="/admin/subcategory/destroy/{{@$subcategory->id}}" method="post"
                                class="d-inline" id="destroy{{ @$subcategory->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Classes</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(@$categories as $category)
                    <tr>
                        <td>{{$category->title}}</td>
                        <td>
                            <a href="/admin/subcategory/index/{{ $category->id }}"
                                class="btn btn-outline-primary delete float-right">
                                View Lessons <i class="fas fa-chevron-right"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endif

            </table>
            @if (@$showSubcat)
            <div class="container">
                {{ $subcategories->links() }}
            </div>
            @else
            <div class="container">
                {{ $categories->links() }}
            </div>
            @endif

            <div style="height: 50px;"></div>
        </div>
    </div>
</div>
@endsection


@section('finalScript')
<script>
    $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
        type : 'get',
        url : '{{URL::to('searchsubcategory')}}',
        data:{'search':$value},
            success:function(data){
            $('tbody').html(data);
        }

    });
})
function deleteItem(e) {
    var choice  = confirm(e.getAttribute('data-confirm'));
    if (choice) {
        document.getElementById(e.nextElementSibling.id).submit();
    }
}
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
