@extends('admin/layout')
@section('content')

<li class="breadcrumb-item active" aria-current="page">Manage Client Accounts</li>
</ol>
</nav>


<div class="row m-1">

    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session()->has('success') || session()->has('message'))
        <div class="alert alert-success mt-3">
            {{session('success') ?? session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    <div class="col-md-12 main">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Class</th>
                        <th scope="col">Email</th>
                        {{-- <th scope="col">Organizational Code</th> --}}
                        <th scope="col">ID Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action
                        </th>
                        <th scope="col">
                            <a href="/admin/users/export" class="btn btn-secondary btn-block float-right"
                                style="width:100px">
                                <i class="fas fa-file-export"></i> <span>Export
                                </span></a>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{@$user->fname}}</td>
                        <td>{{@$user->lname}}</td>
                        <td style="width:20%">
                            <ul>
                              @if($user->categories->count())
                                @foreach($user->categories as $category)
                                  <li>{{$category->title}}</li>
                                  @endforeach
                              @else
                                  No class purchased!
                              @endif
                            </ul>
                        </td>
                        <td><a href="mailto:{{@$user->email}}">{{strtolower(@$user->email)}}</a></td>
                        {{-- <td>{{@$user->org_code}}</td> --}}
                        <td>
                            @if( @$user->id_image )
                            <a href="/storage/ID_Images/{{ $user->id_image }}"> Photo </a>
                            @else
                            No image available
                            @endif
                        </td>
                        <td>
                            <span
                                class="badge badge-pill {{@$user->status == 'Active' ? 'badge-success' : (@$user->status == 'Locked' ? 'badge-warning' : 'badge-danger') }}">{{@$user->status}}</span>
                        </td>
                        <td colspan="2">
                            @if($user->status !== "Active")
                            <form action="/admin/changeStatus/{{$user->id}}/Active" id="confirm-enable-{{$user->id}}" method="post"
                                class="d-inline-block">
                                @csrf
                                <button onclick="confirmEnable('{{@$user->id}}')" type="button"  class="btn btn-success">
                                    <i class="fas fa-user-check"></i>
                                </button>
                            </form>
                            @endif
                            @if($user->status !== "Disabled")
                            <form action="/admin/changeStatus/{{$user->id}}/Disabled" id="confirm-disable-{{$user->id}}" method="post"
                                class="d-inline-block">
                                @csrf
                                <button  onclick="confirmDisable('{{@$user->id}}')" type="button" class="btn btn-warning">
                                    <i class="fas fa-user-slash"></i>
                                </button>
                            </form>
                            @endif

                            <form id="delete-client-{{@$user->id}}" action="/admin/removeClient/{{$user->id}}"
                                method="post" class="d-none">
                                @csrf
                            </form>
                            <button onclick="confirmDelete('{{@$user->id}}')" type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button onClick="editClient({{@$user->id}})" type="button"
                                class="btn btn-secondary editbtn">
                                <i class="fas fa-edit"></i>
                            </button>
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

<!-- Modal -->
<p id="openModal" data-toggle="modal" data-target="#editClient"></p>
<div class="modal fade" id="editClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Client Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/updateClient" method="post">
                    @csrf
                    <input name="id" type="hidden" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="fname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lname" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 class_access">
                            @foreach($categories as $category)

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="categories{{$category->id}}"
                                    name="categories[]" value="{{$category->id}}">
                                <label class="form-check-label" for="categories{{$category->id}}">
                                    {{$category->title}}
                                </label>
                            </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>

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

// Search
$tableData = $('tbody').html();
$paginate = $('#paginate').html();
$('#search').on('keyup',function(){
    $value = $(this).val();


	if($value !== ""){
		$.ajax({
			   type:'GET',
			   url:"{{ URL::to('/admin/searchuser') }}",
			   data:{value:$value, page:'M'},
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

//Edit
function editClient (e){
	console.log(e)
    $id = e;

	$.ajax({
           type:'POST',
           url:"{{  URL::to('/admin/editClient') }}",
           data:{id:$id},
           success:function(data){
			   if(data.user) {
				   $( "input[name*='id']" ).val(data.user['id']);
					$( "input[name*='fname']" ).val(data.user['fname']);
				   	$( "input[name*='lname']" ).val(data.user['lname']);
				   	$( "input[name*='email']" ).val(data.user['email']);

					   document.querySelectorAll(".form-check-input").forEach(function (checkbox, indx) {
						   	$('#'+checkbox.id).attr( "checked", false );
						   	data.categories.forEach(createCheckboxes)
							function createCheckboxes(cat, index, arr){
								if( checkbox.id == "categories"+cat.id){

							   	$('#'+checkbox.id).attr( "checked", true );
						   		}
							}

						});
				   	$('#openModal').click();

			   }else{
			   	 	alert(data.error);
			   }

           }
        });

}

//Delete
function confirmDelete(id){
    let choice = confirm("Are You sure, You want to Delete this Client ?")
    if(choice){
      document.getElementById('delete-client-'+id).submit();
    }
  }
	
	//Disable
function confirmDisable(id){
    let choice = confirm("Are You sure, You want to Disable this Client ?")
    if(choice){
      document.getElementById('confirm-disable-'+id).submit();
    }
  }
	
	//Enable
function confirmEnable(id){
    let choice = confirm("Are You sure, You want to Enable this Client ?")
    if(choice){
      document.getElementById('confirm-enable-'+id).submit();
    }
  }
</script>
@endsection
