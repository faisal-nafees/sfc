@extends('admin/layout')

@section('head')
@endsection

@section('content')
  <li class="breadcrumb-item "><a href="/admin/analytics">Analytics</a></li>
  <li class="breadcrumb-item active" aria-current="page">{{ ucFirst(@$type) }}</li>
  </ol>
  </nav>

  <div class="row m-1 ml-3">
    <div class="table-responsive">
      <table class="table" style="table-layout: fixed; width: 100%">
        <thead class="thead-dark">
          <tr style="background: #353A40 ; color: white">
            <th scope="col">{{ strtoupper(@$type) }}</th>
            <th scope="col">TIME SPEND</th>
            @if (@$data[0]['user_id'])
              <th scope="col">Details</th>
            @endif
          </tr>
        </thead>
        <tbody id="table-body">
          @foreach (@$data as $item)
            <tr>
              <td>
                @if ($item['name'])
                  {{ $item['name'] }}
                @elseif($item['route'])
                  <a href="{{ $item['route'] }}" target="_blank" rel="noopener noreferrer">{{ $item['route'] }}</a>
                @endif
              </td>
              <td>
                @php
                  if ($item['duration']) {
                      $time_spend = \Carbon\CarbonInterval::seconds($item['duration'])
                          ->cascade()
                          ->forHumans();
                  } else {
                      $time_spend = '0 seconds';
                  }
                @endphp
                {{ $time_spend }}
              </td>
              @if (@$item['user_id'])
                <td>
                  <a href="/admin/analytics/{{ $item['user_id'] }}" class="btn btn-info rounded-circle"><i
                      class="fa fa-info px-1" aria-hidden="true"></i></a>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection


@section('finalScript')

@endsection
