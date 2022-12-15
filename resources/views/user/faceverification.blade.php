@extends('classroom.layout')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb ml-3">
      <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Face Verification</li>
    </ol>
  </nav>
  @include('inc.alert')
  <div class="row mx-0">
    <div class="col-md-12">
      <h5>Face Verification</h5>
      <form id action="/face-verify" method="POST" class="mb-3 faceVerificaitonForm">
        @csrf
        <x-webcam />
        <input type="hidden" name="webcamImage" required>
        <button type="button" onclick="verifyInput()" class="btn btn-primary" data-id="Verify">Verify Face</button>
      </form>
    </div>
  </div>
@endsection

@section('script')

  <script>
    webCamInit()

    function verifyInput() {
      $('input[name=webcamImage]').val() == '' ? alert('Please take a picture') : $('.faceVerificaitonForm').submit()
    }

    function webcamCaptured(webcamCapture) {
      $('input[name=webcamImage]').val(webcamCapture)
    }
  </script>

@endsection
