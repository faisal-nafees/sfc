@extends('layouts.app')

@section('title')
Activate Account-
@endsection

@section('head')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<style>
    .filepond--item {
        width: calc(100% - 0.5em);
    }

    @media (min-width: 30em) {
        .filepond--item {
            width: calc(100% - 0.5em);
        }
    }

    @media (min-width: 50em) {
        .filepond--item {
            width: calc(100% - 0.5em);
        }
    }

    .invalid-feedback {
        display: unset !important;
    }

</style>
@endsection

@section('content')
<br>
<div class="container mx-auto">
 
  <button type="button"  hidden id="openPermissionModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#permissionModal"></button>
  <!-- Modal -->
  <div class="modal fade" id="permissionModal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Permission Denied</h4>
        </div>
        <div class="modal-body">
          <p>Please allow the website to access your webcam and refresh the page</p>
        </div>
        <div class="modal-footer">
          <button type="button" id="refreshPermissionDialog" class="btn btn-info btn-lg" data-dismiss="modal">Refresh</button>
        </div>
      </div>
    </div>
  </div>	
	
  <div class="card">
    <div class="card-header">Fill form details below to activate your account</div>

    <div class="card-body">
      
      <br>
      <div class="balert alert alert-danger mt-3" style="display: none">
        <ul>
          <li></li>
        </ul>
        <button type="button" class="close" onclick="this.parentElement.style.display = 'none'" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="balert alert alert-success mt-3" style="display: none">
        <ul>
          <li></li>
        </ul>
        <button type="button" class="close" onclick="this.parentElement.style.display = 'none'" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
      <form method="POST" onsubmit="viaAjax(event)" action="/account-activate" id="activateAccountForm"
        enctype="multipart/form-data" class="dropzone">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
          <label for="id_image" class="col-md-4 col-form-label text-md-right">{{ __('ID Image') }}</label>

          <div class="col-md-6">
            <input id="id_image" type="file" 
              name="id_image" value="{{ $id_image ?? old('id_image') }}" accept="image/png, image/jpeg, image/jpg" autofocus required>
            <p class="text-muted">Max file size: 5MB <br>
              Formats: PNG, JPG, JPEG</p>
            @error('id_image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
			
        </div>
		  


        <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

          <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

          <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="new-password" value="">

            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
            {{ __('Confirm Password') }}
          </label>

          <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
              autocomplete="new-password" value="">
          </div>
        </div>

        @php
        $poseDirections = ['forward', 'right', 'left', 'up', 'down'];
        @endphp
        <br>
        {{-- Face Verification --}}
        <div class="col-lg-12 my-2" id="face-verification-div">
          <h5>Face Verification</h5>
          <label>Please capture five clear photos of your face.</label>
          <!-- Button trigger modal -->
          {{-- <div class="capture-img-container">
            @foreach ($poseDirections as $poseDirection)
            <div onclick="webcamModal(this, '{{ $poseDirection }}') " class="d-inline-block webcam-photos text-center"
              id="webcam_image_{{ $poseDirection }}">
              <label for="imaga-{{ $poseDirection }}" class="add-photo card" data-bs-toggle="modal"
                data-bs-target="#webcamModal">
                <div class="empty">
                  <i class="fa fa-camera" aria-hidden="true"></i>
                </div>
                <div class="filled">
                  <img src="" class="img-fluid">
                </div>
              </label>
              <h5>{{ ucfirst($poseDirection) }}</h5>
              <input id="image-{{ $poseDirection }}" type="text" name="webcam_image_{{ $poseDirection }}"
                class="form-control webcam-input d-none" />
            </div>
            @endforeach
          </div> --}}

          <div class="face alert alert-danger mt-3" style="display: none">
            <ul>
              <li></li>
            </ul>
            <button type="button" class="close" onclick="this.parentElement.style.display = 'none'" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="d-flex flex-column flex-lg-row" style="gap: 3rem;">
            <div class="c justify-content-end" style="max-width: 35%">
              <p class="lead text-danger text-start">
                LOOK <b class="face-direction">FORWARD</b>
              </p>
              <img class="face img-fluid " src="/img/faces/forward.png" alt="face-direction">
            </div>
            <div class="c w-100">
              <x-webcam class="my-0 w-100" />
            </div>
          </div>
          <input type="hidden" name="verified_face_uuid_{{ $poseDirections[0] }}" id="image-{{ $poseDirections[0] }}">
          <input type="hidden" name="webcam" disabled>
        </div>

      

        <div class="form-group mb-0">
          <button type="submit" class="btn btn-lg btn-primary w-100" style="display: none">
            {{ __('Set password and activate account') }}
          </button>
          <button class="btn btn-primary btn-lg  w-100" type="button" disabled style="display: none">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="visually-hidden">Submiting Form...</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/js/script.js"></script>
<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>


<script>
	$('#refreshPermissionDialog').on('click', function () {
		location.reload();
    });
	
	
  const webcam = getEl("input[name=web_cam]")
    let poseDirections = @json($poseDirections);
    let currentFaceDirection = poseDirections[0];
    let defaultErrorMsg = 'Something went wrong. Please try again.';
    let id_card_pond;
    // First register any plugins
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

    $('#id_image').filepond({
      credits:{
        label: '',
        url: ''
      },
      storeAsFile: true,
    });
    $('#id_image').on('FilePond:addfile', function (e) {
      console.log('file added event', e, e.originalEvent.detail);
      if(['png', 'jpg', 'jpeg'].indexOf(e.originalEvent.detail.file.fileExtension) <= 0){
        laravelErrors({
          'id_image': 'Only PNG, JPG and JPEG images are allowed'
        })
        e.originalEvent.detail.pond.removeFile();
        return
      }
        id_card_pond = e.originalEvent.detail.pond;
		var file = id_card_pond.getFile().file;
		console.log(file);
		verifyFaceId(file);
		
    });
    
		  
function verifyFaceId(captureImg){

   url = 'https://sfc2.cognitiveservices.azure.com/face/v1.0/detect?overload=stream&returnFaceAttributes=headPose&detectionModel=detection_03&recognitionModel=recognition_04&returnRecognitionModel=True';
        fetch(url, {
            headers: {
              'Content-Type': 'application/octet-stream',
              'Ocp-apim-subscription-key' : 'd739258ed7234d1097f5a62953671726',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            method: 'post',
            body:  captureImg,
          })
          .then(function(response) {
            return response.json();
          })
          .then( function(data) {
            if (data && data.length>0 && data[0].faceRectangle && data[0].faceAttributes.headPose) {
				$("#id_card").filepond('allowReplace', false)
				$("#id_card").filepond('allowRemove', false)
				bAlert('success', 'face-id verified! please proceed to fill details');
				$('.alert').fadeOut(5000);	  
            } else {
              throw new Error(data?.error);
            }
          })
          .catch(function(error) {
				$("#data_show_pitch").text("Pitch error 2 "+error);
				laravelErrors({
				  'id_image': 'face id not verified, '+ error
				})
            	console.log({error})
          })
}
    // Init Webcam
    webCamInit()
    // Modify webcam component to work with this page
    $("button.reset").attr('hidden', true)
    $("button.screenshot").addClass('d-block')

    // Webcam on Capture Callback function
    function webcamCaptured(imgCapture) {
      $('.alert').hide();
      if(document.querySelector("#activateAccountForm").reportValidity()) {
        latestWebcamCapture = imgCapture
        verifyHeadPose()
      }else{
        resetWebcam()
      }
    }

    // Verify Head Pose
    function verifyHeadPose(el) {
      try{
        $("#webCam").append( /*html*/ `
          <button type="button" class="temp-loading-btn btn btn-primary w-100" disabled>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Verifying...
          </button>
          `);
        let id = $(el).data('id')
        url = '/verify-head-pose';
        fetch(url, {
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            method: 'post',
            body: JSON.stringify({
              face_image: latestWebcamCapture,
              direction: currentFaceDirection,
				      email:'{{@$email}}'
            }),
          })
          .then(function(response) {
            return response.json();
          })
          .then( function(data) {
            if (data?.success && data.temp_face_path) {
             matchFaceWithIDCard(currentFaceDirection, data,function(data){
                $('.face.alert').hide();
                $("#image-" + currentFaceDirection).val(data.temp_face_path)
                // $("#webcam_image_" + id + " img").attr("src", latestWebcamCapture)
                poseDirections = poseDirections.filter(dir => {
                  return dir == currentFaceDirection ? false : true;
                })
                if (poseDirections.length == 0) {
                  //!TODO: fix this
                  $("#webCam .temp-loading-btn").html( /*html*/ `
                    <i class="fa fa-check" aria-hidden="true"></i> Face Verified
                    `)
                  $("#activateAccountForm button[type='submit']").slideDown();
                } else {

                  $("#image-" + currentFaceDirection).after(
                    `<input hidden type="text" name="verified_face_uuid_${poseDirections[0]}" id="image-${poseDirections[0]}">`
                    )
                  $("#webCam .temp-loading-btn").remove();
                  currentFaceDirection = poseDirections[0];
				  resetWebcam();
                  $('img.face').attr("src", "/img/faces/" + currentFaceDirection + ".png")
                  let dirArrowIcon = (currentFaceDirection != 'forward') ? '  <i class="fas fa-arrow-' +
                    currentFaceDirection + '"></i>' : '';
                  $('.face-direction').html(currentFaceDirection.toUpperCase() + dirArrowIcon)

                }
              })
            } else {
              throw new Error(data?.error);
            }
          })
          .catch(function(error) {
            console.log({error})
            resetWebcam()
            $("#webCam .temp-loading-btn").remove();
            bAlert('danger', error?.message || defaultErrorMsg, '.face');
           // toast('danger', 'Error', 'Something went wrong. Please try again.');
          })
      }catch(error){
        console.log(error)
        bAlert('danger', defaultErrorMsg, '.face');
         // toast('danger', 'Error', 'Something went wrong. Please try again.');
      }

    }

					  $("#id_card").filepond('allowRemove', false)
    function matchFaceWithIDCard(currentFaceDirection, cbdata, callback){
      try{
        if(currentFaceDirection === 'forward'){
          let data;
          var fileReader = new FileReader();
          fileReader.onload = function () {
            console.log({fileReader})
            fetch("/match-faces", {
              method: "post",
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              },
              body: JSON.stringify({
                face_one: fileReader.result,
                face_two: latestWebcamCapture
              }),
            })
            .then(res => res.json())
            .then(data => {
              console.log(data)
              if(data.hasOwnProperty('success')){
				  if(data.success === true){
					if(id_card_pond){
					  $("#id_card").filepond('allowReplace', false)
					  $("#id_card").filepond('allowRemove', false)
					}
                	callback(cbdata);
				  }else{
					  resetWebcam()
					  bAlert('danger', "Your face didn't match with the face in ID Card! Please capture clear image of your face.", '.face')
				  }
              }else{ 
                resetWebcam()
                if(typeof data?.errors === 'object'){
                  let errors = data?.errors
                  errors=errors?.face_one ? renameProperty(errors,'face_one', 'id_image') :errors
                  errors=errors?.face_two ? renameProperty(errors,'face_two', 'webcam') : errors
                  laravelErrors(data?.errors)
                }else{
                  throw new Error(defaultErrorMsg);
                }
              }
            })
            .catch(err => {
				console.log(err)
              resetWebcam()
              bAlert('danger', err.message || defaultErrorMsg, '.face');
            }).finally(function(){
              $("#webCam .temp-loading-btn").remove();
            })
          };
          fileReader.readAsDataURL(document.querySelector('input[name=id_image]').files[0]);
          console.log(data)
          // alert('match')
        }else{
          callback(cbdata);
        }
      }catch(error){
        console.log(error)
        $("#webCam .temp-loading-btn").remove();
        resetWebcam()
        bAlert('danger', defaultErrorMsg, '.face');
         // toast('danger', 'Error', 'Something went wrong. Please try again.');
      }
    }
    
    checkUserFaceVerified()
    function checkUserFaceVerified() {
    
        //$("#face-verification-div").hide();
        // $("#activateAccountForm button[type='submit']").slideDown();
        const headers = {
            'X-Requested-With': 'XMLHttpRequest',
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            'Accept':'application/json',
            'Content-Type':'application/json'
          }
        const url = "/verify-face-verified"
        fetch(url, {
              method: 'POST',
              headers: headers,
              body: JSON.stringify({email:'{{@$email}}'})
            })
            .then(res => res.json())
            .then(data => {
              if(data.success){
                $("#face-verification-div").hide();
                $("#activateAccountForm button[type='submit']").slideDown();
              }
            })
            .catch(err => {
              console.log(err)
              //   alert('Something went wrong. Please try again.');
            })

    }

  let webcamError;
  function viaAjax(e){
    // submit form via AJAXe.preventDefault();
    e.preventDefault() ;
    $(e.target).find('button[type="submit"]').hide().next().show();
    $('.is-invalid').removeClass('is-invalid');
    $('[class="invalid-feedback"]').remove();
    let errorMSG = "Something went wrong. Please try again!"
    webcamError = false;
    $.ajax({
      url: $(e.target).attr('action'),
      type: "POST",
      data: new FormData(e.target),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        console.log({response}, typeof response.errors !== 'object' )
        if(typeof response.redirect !== 'undefined') {
          location = response.redirect
        }else if(typeof response.errors !== 'undefined' ) {
          if(typeof response.errors === 'object' && Object.keys(response.errors).length ){
            $.each(response.errors,function(field_name,error){
              let field = field_name
              if(typeof field_name === 'string'){
                if(field_name.includes("verified_face_uuid")){
                  if(webcamError) return;
                  webcamError = true;
                  field = 'webcam';
                }
                showFieldError(field,error)
              }else{
                bAlert('danger', error || errorMSG)
              }
              return false;
            })
          }
        }else{
          bAlert('danger', errorMSG)
        }
      },
      error: function(e) {
        console.log(e);
        if(
          typeof e.responseText !== 'undefined' 
          && IsJsonString(e.responseText)
          && typeof JSON.parse(e.responseText).errors === 'object' 
          && Object.keys(JSON.parse(e.responseText).errors).length
        ) {
          errorMSG = '';
          $.each(JSON.parse(e.responseText).errors,function(field_name,error){
              let field = field_name
              if(typeof field_name === 'string'){
                if(field_name.includes("verified_face_uuid")){
                  if(webcamError) return;
                  webcamError = true;
                  field = 'webcam';
                }
                showFieldError(field,error)
              }else{
                bAlert('danger', error || errorMSG)
              }
              return false;
          })
        }else{
          bAlert('danger', errorMSG)
        }
      },
      complete: function(data){
        webcamError = false;
        $(e.target).find('button[type="submit"]').show().next().hide();
      }
    });
    
  }

  function showFieldError(field_name,error){
      let el= $(`.form-group .form-control[name=${field_name}]`);
      if(!el || el.length <=0){
        bAlert('danger', error )
        return
      }
      el.addClass('is-invalid')
      el.closest('.form-group').append('<span class="invalid-feedback text-danger" role="alert">' +error+ '</span>')
      $([document.documentElement, document.body]).animate({
          scrollTop: el.offset().top
      }, 500);
  }
	
	function bAlert(color, msg, selectorClass = '.balert'){
    $('.alert').hide();
		$(selectorClass +'.alert-'+color).show();
		$(selectorClass +'.alert-'+color+' ul li').html(msg)
	}

  function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
  }

function laravelErrors(errors){
  if(typeof errors !== 'object'){
    return
  }
  let errorMSG = 'Sorry something went wrong!!';
  Object.entries(errors).forEach(function([field_name, error]){
      if(typeof field_name === 'string'){
        showFieldError(field_name,error)
      }else{
        bAlert('danger', error || errorMSG)
      }
      return false;
  })
}
function renameProperty(Obj, oldName, newName) {
     // Do nothing if the names are the same
     if (oldName === newName) {
         return this;
     }
    // Check for the old property name to avoid a ReferenceError in strict mode.
    if (Obj[oldName]) {
      Obj[newName] = Obj[oldName];
        delete Obj[oldName];
    }
    return Obj;
};
</script>

@endsection