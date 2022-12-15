@extends('admin/layout')
@section('content')

<li class="breadcrumb-item active" aria-current="page">Client</li>
</ol>
</nav>


<div class="row m-1">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Email</th>
                        {{-- <th scope="col">Organizational Code</th> --}}
                        <th scope="col">ID Image <a class="btn btn btn-secondary float-right "
                                href="/admin/users/export"><i class="fas fa-file-export"></i> Export</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)

                    <tr>
                        <td>{{@$user->fname}}</td>
                        <td>{{@$user->lname}}</td>
                        <td style="width:20%">
                            <ul>
                                @foreach($user->categories as $category)
                                <li>{{$category->title}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td><a href="mailto:{{@$user->email}}">{{strtolower(@$user->email)}}</a></td>
                        {{-- <td>{{@$user->org_code}}</td> --}}
                        <td><a
                                href="@if(@$user->id_image) /storage/ID_Images/{{$user->id_image}} @endif">{{@$user->id_image}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12">
        <div id="paginate" class="container ">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection


@section('finalScript')
<script>
    $.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

//Search
$tableData = $('tbody').html();
$paginate = $('#paginate').html();
$('#search').on('keyup',function(){
    $value = $(this).val();


	if($value !== ""){
		$.ajax({
			   type:'GET',
			   url:"{{ URL::to('/admin/searchuser') }}",
			   data:{value:$value, page:'C'},
			   success:function(data){
				   if(data.user) {
					   $('tbody').html(data.user);
					   $('#paginate').html('');
				   }
			   }
			});

	}else{
		$('tbody').html($tableData);
		$('#paginate').html($paginate);
	}

})
</script>
@endsection
