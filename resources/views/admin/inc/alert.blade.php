    @if (Session::has('message'))
      <div class="alert alert-success col-10 p-3 mt-3">
        <ul>
          <li>{{ Session::get('message') }}</li>
        </ul>
      </div>
    @endif
    @if (Session::has('error'))
      <div class="alert alert-danger col-10 p-3 mt-3">
        <ul>
          <li>{{ Session::get('error') }}</li>
        </ul>
      </div>
    @endif
    @if (Session::has('errors'))
      <div class="alert alert-danger col-10 p-3 mt-3">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
