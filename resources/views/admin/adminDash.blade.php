@extends('admin/layout')
@section('content')
</nav>

<div class="row m-1">
    <div class="col-md-6 h-50 mb-4 mt-3 mt-md-0" style="border: 1px solid rgb(172, 172, 172)">
        <h4 class="text-center mb-3">Classes purchased</h4>
        <canvas id="myChart" width="400px" height="300px"></canvas>
    </div>
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Class</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)

                    <tr>
                        <td>{{@$user->fname}}</td>
                        <td>{{@$user->lname}}</td>
                        <td style="width:60%">
                            <ul>
                                @foreach($user->categories as $category)
                                <li>{{$category->title}}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div id="paginate" class="container ">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


@section('finalScript')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha256-t9UJPrESBeG2ojKTIcFLPGF7nHi2vEc7f5A2KpH/UBU=" crossorigin="anonymous"></script>
<script>
    /* -------------------------------------------------------------------------- */
/*                                    CHART                                   */
/* -------------------------------------------------------------------------- */

var categories              = @json(@$categories);
var categoryPurchaseCount   = @json(@$categoryPurchaseCount);
var categoryNames           = @json(@$categoryNames);
if(categoryNames){
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: categoryNames,
            datasets: [
                {
                    label: "Classes Sold",
                    data: categoryPurchaseCount,
                    backgroundColor: [
                        "#084C61",
                        "#DB504A",
                        "#E3B505",
                        "#4F6D7A",
                        "#56A3A6",
                        "#92B6B1",
                        "#5679C0",
                        "#ffffff"
                    ],
                    borderColor: [
                        "rgba(0, 0, 0, 1)",
                        "rgba(0, 0, 0, 1)",
                        "rgba(0, 0, 0, 1)",
                        "rgba(0, 0, 0, 1)",
                        "rgba(0, 0, 0, 1)",
                        "rgba(0, 0, 0, 1)",
                        "rgba(0, 0, 0, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                        },
                    },
                ],
            },
        },
    });
}
var ctx = document.getElementById("myChart2").getContext("2d");
var myChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
            {
                label: "",
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                ],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
        },
    },
});
/* -------------------------------------------------------------------------- */



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
			   data:{value:$value},
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
