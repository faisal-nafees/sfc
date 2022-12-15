@extends('classroom/layout')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb ml-3">
        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Certificates</li>
    </ol>
</nav>
<div class="row mx-0">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Class</th>
                    <th scope="col">Pass/Fail</th>
                    <th scope="col">Certificate</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classResults as $classResult)
                    <tr>
                        <td>{{ $classResult['title'] }}</td>
                        <td>{{ $classResult['result'] }}</td>
                        <form action="/certificate/{{ $classResult['id'] }}" method="GET">
                            @if($classResult['result'] == "Pass")
                            <td><button type="submit" class="btn btn-secondary" >Print</button></td>
                            @else
                            <td></td>
                            @endif
                        </form>
                    </tr>
                @empty
                <tr>
                    <td colspan="3">You haven't completed any class!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
