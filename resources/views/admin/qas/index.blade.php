@extends('admin/layout')
@section('content')
<li class="breadcrumb-item active" aria-current="page">Q&A</li>
</ol>
</nav>
<!-- Floating CTA Button Start -->
<a href="/admin/qas/create" onclick="hideNav()" class="float d-flex justify-content-center align-items-center"><span><i
            class="fas fa-plus feather fa-2x"></i></span>
</a>
<!-- Floating CTA Button End -->
<div class="row m-1">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table">
                @if (@$showCat)
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
                            <a href="/admin/qas/subcategory/{{ $category->id }}"
                                class="btn btn-outline-primary delete float-right">
                                View Lessons <i class="fas fa-chevron-right"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @elseif(@$showSubcat)
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Lessons</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(@$subcategories as $subcategory)
                    <tr>
                        <td>{{$subcategory->title}}</td>
                        <td>
                            <a href="/admin/qas/index/{{ $subcategory->id }}"
                                class="btn btn-outline-primary delete float-right">
                                View Q & A <i class="fas fa-chevron-right"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Classes</th>
                        <th scope="col">Lessons</th>
                        <th scope="col">Question</th>
                        {{-- <th scope="col">Option 1</th>
                            <th scope="col">Option 2</th>
                            <th scope="col">Option 3</th>
                            <th scope="col">Option 4</th> --}}
                        <th scope="col">Answer</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qas as $qa)
                    <tr>
                        <td>{{@$qa->category->title}}</td>
                        <td>{{@$qa->subcategory->title}}</td>
                        <td>{{@$qa->question}}</td>
                        {{-- <td>{{@$qa->option1}}</td>
                        <td>{{@$qa->option2}}</td>
                        <td>{{@$qa->option3}}</td>
                        <td>{{@$qa->option4}}</td> --}}
                        <td class="text-capitalize">{{@$qa->answer}}</td>
                        <td>
                            @if(@$qa->active == "Y")
                            {!! '<div class="badge badge-success"> Yes </div>' !!}
                            @else
                            {!! '<div class="badge badge-danger"> No </div>' !!}
                            @endif
                        </td>
                        <td style="width:120px">
                            <a href="/admin/qas/edit/{{@$qa->id}}" class="btn btn-primary "><i
                                    class="far fa-edit"></i></a>
                            <a href="#" data-confirm="Are you sure to delete this Ques&Ans?" onClick="deleteItem(this)"
                                class="btn btn-danger delete"><i class="fas fa-trash"></i></a>

                            <form action="/admin/qas/destroy/{{@$qa->id}}" method="post" class="d-inline"
                                id="destroy{{ @$qa->id }}">
                                @csrf
                                @method('DELETE')
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
                {{ $qas->links() }}
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
        url : '{{URL::to('searchqa')}}',
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
