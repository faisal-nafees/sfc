@extends('admin/layout')

@section('head')
@endsection

@section('content')
  <li class="breadcrumb-item active" aria-current="page">Analytics</li>
  </ol>
  </nav>

  <div class="row m-1 gy-4">
    <div class="col-12  mb-4">
      <div class="card bg-dark">
        <div class="card-body">
          <h2 class="text-info">{{ @$user ? @$user->fname . ' ' . @$user->lname : 'All Users' }}</h2>
          <h5 class="text-light">{{ @$user ? @$user->email : null }}</h5>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Classes</h3>
          <p class="card-text"><a
              href="/admin/analytics-group-by/classes{{ @$user->id ? '/' . $user->id : '' }}">View
              Details <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Lessions</h3>
          <p class="card-text"><a
              href="/admin/analytics-group-by/lessons{{ @$user->id ? '/' . $user->id : '' }}">View
              Details <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> </a></p>
        </div>
      </div>
    </div>
    @if (!@$user->id)
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Users</h3>
            <p class="card-text"><a
                href="/admin/analytics-group-by/users{{ @$user->id ? '/' . $user->id : '' }}">View
                Details <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
            </p>
          </div>
        </div>
      </div>
    @endif
    <div class="col-12 col-md-6 col-lg-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Pages</h3>
          <p class="card-text"><a
              href="/admin/analytics-group-by/pages{{ @$user->id ? '/' . $user->id : '' }}">View
              Details <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('finalScript')

@endsection
