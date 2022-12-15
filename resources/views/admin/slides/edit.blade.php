@extends('admin/layout')

@section('content')
  <li class="breadcrumb-item active" aria-current="page"><a
      href="/admin/slides/index/{{ @$slide->subcategory_id }}">Slides</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit {{ $slide->id }}</li>
  </ol>
  </nav>
  <div class="row d-flex justify-content-center mt-5">

    @include('admin/inc/alert')
    <!-- Button trigger modal -->
    {{-- <a id="floatingBtn" href="/admin/slides/slideOrder/{{ $slide->id }}" class="btn btn-primary">
      Slide Order
    </a> --}}

    <div class="col-md-10 card py-5 px-4">
      {{-- Slide Details --}}
      <form method="POST" action="/admin/slides/update-details/{{ $slide->id }}" enctype="multipart/form-data"
        name="slideupdateform" class="row">
        <div class="col-12 my-3">
          <h4>Slides Details:</h4>
        </div>
        @csrf
        {{-- Category --}}
        <div class="col-md-6 ">
          <div class="form-group">
            <label for="category_id">Class</label>
            <select name="category_id" id="category_id" class="form-control" required>
              <option value="">Select an option</option>
              @foreach ($categories as $category)
                <option @if (old('category_id', @$slide->category_id) == $category->id)
                  {{ 'selected' }}
              @endif
              value="{{ $category->id }}">{{ $category->title }}</option>
              @endforeach
            </select>
            @ERROR('category_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        {{-- Subcategory --}}
        <div class="col-md-6">
          <div class="form-group">
            <label for="subcategory_id">Lesson</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control" required>
              <option value="">Select an option</option>
              @foreach ($subcategories as $subcategory)
                <option @if (old('subcategory_id', @$slide->subcategory_id) == $subcategory->id)
                  {{ 'selected' }}
              @endif
              value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
              @endforeach
            </select>
            @error('subcategory_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        {{-- Active --}}
        {{-- <div class="col-md-12">
          <div class="form-group">
            <label for="active">Active</label>
            <select name="active" id="active" class="form-control" required>
              <option @if (old('active') == 'Y') {{ 'selected' }}
              @elseif(old("active")=="" && $slide->
                active == "Y") {{ 'selected' }} @endif value="Y">Yes</option>
              <option @if (old('active') == 'N') {{ 'selected' }}
              @elseif(old("active")=="" && $slide->
                active == "N") {{ 'selected' }} @endif value="N">No</option>
            </select>
            @error('active')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div> --}}

        <div class="col-md-12">
          <button type="submit" data-action="edit" class="btn btn-success btn-block">
            Update
          </button>
        </div>
      </form>
      <br>
      <hr>

      {{-- Slide Content --}}
      <div class="row">
        <!-- -------------------------------- SLIDE -------------------------------- -->
        <div class="col-12 mt-3 mb-n3">
          <h4>Slides:</h4>
          <br>
          <a href="/admin/slides/slideOrder/{{ $slide->id }}" class="btn btn-primary btn-block">
            Change Slide Order &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>
          </a>
          <br>
        </div>

        @for ($slideCount = 1; $slideCount <= $slide->total_slide; $slideCount++)
          <form onsubmit="updateSlideContent(event, this)" method="POST"
            action="/admin/slides/update-slide-content/{{ $slide->id }}/{{ $slideCount }}"
            enctype="multipart/form-data" name="slideContent{{ $slideCount }}" class="col-md-12 mb-4"
            id="slide{{ $slideCount }}">
            <div class="addSlide">
              @csrf
              <p id="slideCounter{{ $slideCount }}">{{ $slideCount }}</p>
              <p id="deleteSlide{{ $slideCount }}" class="deleteSlide">
                <a href="javascript:;" onclick="deleteSlide(this)"> <i class="fas fa-times"></i> </a>
              </p>
              @if (@$slide->slideContents->where('slide_index', $slideCount)->first()->image)
                <!-- ------------------------------ IF IMAGE ------------------------------- -->
                <x-admin.slide.image :slide="$slide" :slideCount="$slideCount" />
              @elseif(@$slide->slideContents->where('slide_index', $slideCount)->first()->video)
                <!-- ------------------------------ IF VIDEO ------------------------------- -->
                <x-admin.slide.video :slide="$slide" :slideCount="$slideCount" />
              @elseif(@$slide->slideContents->where('slide_index', $slideCount)->first()->qa_id)
                <!-- ------------------------------- IF Q&A -------------------------------- -->
                <x-admin.slide.qa :slide="$slide" :slideCount="$slideCount" :qas="$qas" />
              @else
                <div class="col-md-12 addSlide " id="slide{{ $slideCount }}">
                  <p id="slideCounter{{ $slideCount }}">{{ $slideCount }}</p>
                  <p id="deleteSlide{{ $slideCount }}" class="deleteSlide">
                    <a href="javascript:;" class="" onclick="deleteSlide(this)"> <i
                        class="fas fa-times"></i></a>
                  </p>
                  <div class="addQuesAns pt-5 col-md-12 ">
                    <textarea name="custom" id="custom" cols="30" rows="10"></textarea>
                  </div>
                </div>
              @endif

              <div class="disabled-overlay">
                <button type="button" onclick="contentUpdateBtn(this)" data-action="edit"
                  class="btn btn-success btn-block">
                  <i class="fas fa-edit"></i>
                  Edit
                </button>
              </div>
            </div>
          </form>
        @endfor


        <div onClick="addNewSlide(this)" class="col-12 text-center ">
          <button id="addNewSlideBtn" type="button" data-classname="addNewSlide" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Slide
          </button>
        </div>

        <input id="totalSlides" name="totalSlides" type="hidden" value="{{ $slideCount }}">


      </div>
      {{-- <button type="submit" class="btn btn-success mt-3">Update</button> --}}
      {{-- </form> --}}

      <div id="qaInputs" class=" d-none"> </div>
    </div>
  </div>
@endsection

@section('finalScript')
  <script>
    /* -------------------------------------------------------------------------- */
    /*                             //Global Variables                             */
    /* -------------------------------------------------------------------------- */
    $slideID = @json($slide->id);
    $sqCount = {{ $slideCount }};
    $qas = "";
    $subcategories = @json($subcategories);

    // Scroll to last slide
    // $(window).on('load', function() {
    //   $lastSlide = $sqCount - 1;
    //   $('html, body').animate({
    //     scrollTop: $("#slide" + $lastSlide).offset().top
    //   }, 0);
    // });

    // Save btn
    $saveBtn = /*html*/ `
    <div class="disabled-overlay save">
      <button type="button" onclick="contentUpdateBtn(this)" data-action="save"
        class="btn btn-success btn-block">
        <i class="fas fa-save"></i>
        SAVE
      </button>
    </div>
    `;
    // Audio Input
    const audioInput = (sqCount) => {
      return /*html*/ `
            <div class="form-group">
              <label for="slide_audio${ sqCount }">Audio</label>
              <input id="slide_audio${ sqCount }" type="file" class="form-control-file"
                  name="slide_audio${ sqCount }" accept="audio/mp3, audio/wav, audio/ogg">
              <span class="text-danger">Max file size: 8MB</span>
              <br>
              <a href="javascript:void(0)" onclick="removeAudio(this)" data-slide-count="${ sqCount }"  class="btn btn-danger mt-3">Remove Audio</a>
            </div>
            `
    }


    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    /* -------------------------------------------------------------------------- */


    /* -------------------------- //On Category select -------------------------- */
    $('#category_id').change(function(e) {
      $oldVal = {{ old('subcategory_id', 0) }};

      $('#subcategory_id').html(``);
      $('#subcategory_id').append(`<option value="">Select an option</option>`);
      $.each($subcategories, function(index, $subcategory) {
        if ($subcategory.slide == null && $subcategory.category_id == $('#category_id').val()) {
          if ($oldVal) {
            $('#subcategory_id').append(`
                    <option` +
              $oldVal == $subcategory.id ? "selected" : "" +
              `value="` + $subcategory.id + `">` + $subcategory.title + `</option>
                `);
          } else {
            $('#subcategory_id').append(`
                    <option value="` + $subcategory.id + `">` + $subcategory.title + `</option>
                `);
          }
        }
      });
    });

    function addQuesToSelectlist() {
      $value = $('#subcategory_id').val();
      $.ajax({
        type: 'get',
        url: '/admin/slides/getqas',
        data: {
          'subcat_id': $value,
        },
        success: function(qas) {
          if ($('#active').length) {
            $('#qaInputs').html(qas);
            $('.qaSelect').html(`<option value="">Select a question</option>
                    ` + $("#qaInputs").html());
          } else {
            $('#qaInputs').html(qas);
          }

        }
      });
    }
    addQuesToSelectlist();
    /* -------------------------------------------------------------------------- */

    /* ------------------------- //On subcategory select ------------------------ */
    $('#subcategory_id').change(function(e) {
      addQuesToSelectlist();
      $('.qaSelect').val('');
    })
    /* -------------------------------------------------------------------------- */

    /* ---------------------------- //Add a new slide --------------------------- */
    function addNewSlide(e) {
      if (document.slideupdateform.reportValidity()) {
        // $(e).children('button').html(`
      //     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving Progress
      // `);
        if ($('#slide' + ($sqCount - 1)).find('.btn-success i.fa-save').length) {
          $('#slide' + ($sqCount - 1)).submit();
        }
        $('#slide' + ($sqCount - 1)).after( /*html*/ `
            <form onsubmit="updateSlideContent(event, this)" method="POST"
                action="/admin/slides/update-slide-content/${ $slideID }/${ $sqCount }"
                enctype="multipart/form-data" name="slideContent${ $sqCount }" class="col-md-12 mb-4"
                id="slide${ $sqCount }">
                <div class="addSlide">
                    <div class="addSlideBtns p-3 d-flex justify-content-center align-content-center h-100  mx-auto row">
                    <button type="button" onClick="addSlideType(this)" data-classname="addImage"
                        class="col-12 btn btn-primary my-3 "><i class="fas fa-image"></i> Add Image</button>
                    <h4 class="col-12 text-center text-muted"></h4>
                    <button type="button" onClick="addSlideType(this)" data-classname="addVideo"
                        class="col-12 btn btn-primary my-3 "> <i class="fab fa-youtube"></i> Add Video</button>
                    <h4 class="col-12 text-center text-muted"></h4>
                    <button type="button" onClick="addSlideType(this)" data-classname="addQuesAns"
                        class="col-12 btn btn-primary my-3 "><i class="fas fa-question"></i> Add Q&A</button>
                    </div>
                </div>
            </form>
        `)
        $("#addNewSlideBtn").hide()
      }
    }
    /* -------------------------------------------------------------------------- */


    /* ------------------------------ //Delete Q&A ------------------------------ */
    function deleteQA(e) {
      $(e).parent().parent().remove();
    }
    /* -------------------------------------------------------------------------- */

    // Select slide type
    function addSlideType(e) {
      $(e).parent().toggle();
      //New Slide Button
      // $(e).parent().parent()
      //   .after(`
    //   <div onClick="addNewSlide(this)" class="col-12 text-center ">
    //       <button type="button" data-classname="addNewSlide" class="btn btn-primary">
    //         <i class="fas fa-plus"></i> Add New Slide
    //       </button>
    //   </div>
    //   `);
      if ($(e).attr('data-classname') === "addImage") {
        //Add image
        $(e).parent().parent()
          .html( /*html*/ `
        <p id="slideCounter${ $sqCount }">${ $sqCount }</p>
        <p id="deleteSlide${ $sqCount }"  class="deleteSlide" >
            <a href="javascript:void(0)" onclick="deleteSlide(this)" ><i class="fas fa-times"></i></a>
        </p>
        <div class="addImage w-100 row mx-auto">
            <div class="col-md-12 pb-3">
                <div class="form-group">
                    <label for="slide_content${ $sqCount }">Image</label>
                    <div class="d-block mb-3">
                        <img src="" class="fluid" alt="">
                    </div>
                    <input id="slide_content${ $sqCount }" onchange="readURL(this)" type="file" class="form-control-file "
                        name="slide_content${ $sqCount }" accept="image/*" required>
                </div>
            </div>
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              ${audioInput( $sqCount )}
            </div>
            <div class="col-12">
              <hr>
            </div>
            <div class="col-md-4 ">
                <div class="form-group ">
                    <label for="cool_down${ $sqCount }">Slide Cool Down Time(in Seconds)</label>
                    <input name="cool_down${ $sqCount }" id="cool_down${ $sqCount }" class="form-control" type="number" value="60" min="0" required>
                </div>
            </div>
        </div>
        ${$saveBtn}
        `);
        $('#totalSlides').val($sqCount);
        $sqCount++;
      } else if ($(e).attr('data-classname') === "addVideo") {
        //Add Video btn
        $(e).parent()
          .html( /*html*/ `
                <button type="button" onClick="addVideo(this)" data-classname="URL" class="col-12 btn btn-primary my-3 ">Add Video URL</button>
            `);
      } else {
        //Add Q&A
        $(e).parent().parent()
          .html( /*html*/ `
            <p id="slideCounter${$sqCount}">${$sqCount}</p>
            <p id="deleteSlide${$sqCount}"  class="deleteSlide" >
                <a href="javascript:void(0)"   onclick="deleteSlide(this)" ><i class="fas fa-times"></i></a>
            </p>
            <div class="addQuesAns col-md-12 w-100 ">
                <div class="form-group">
                    <label >Question:</label>
                    <div class="input-group mb-3">
                        <select name="slide_content${$sqCount}[]" class="form-control slide_content${$sqCount} qa-sel" onchange="verifyDuplicateQA(this)"  required>
                            <option value="">Select a question</option>
                            ${$("#qaInputs").html()}
                        </select>
                        <a href="javascript:;" class="input-group-text" onclick="deleteQA(this)"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <a href="javascript:;" onclick="addNewQa(this)" data-classname="addNewSlide" data-name="slide_content${$sqCount}" class=" btn btn-primary my-3 "><i class="fas fa-plus"></i>  Add New Q&A</a>
                <hr>
              ${audioInput( $sqCount )}
            </div>
            <input name="cool_down${$sqCount}" id="cool_down${$sqCount}"  class="form-control" type="hidden" value="0" min="0" required>
          ${$saveBtn}
        `);

        $('#totalSlides').val($sqCount);
        $sqCount++;
      }
    }

    // Add Video
    function addVideo(e) {
      $(e).parent().parent().html( /*html*/ `
        <p id="slideCounter${$sqCount}">${$sqCount}</p>
        <p id="deleteSlide${$sqCount}"  class="deleteSlide"  >
            <a href="javascript:;"  onclick="deleteSlide(this)" ><i class="fas fa-times"></i></a>
        </p>
        <div class="addVideo  w-100 row mx-auto">
            <div class="col-md-12 py-5">
                <div class="form-group">
                    <label for="slide_content${$sqCount}">Video</label>
                    <div class="mb-3 iframe-container">
                        <iframe id="video${$sqCount}" src=""  ></iframe>
                    </div>
                    ${
                      $(e).attr('data-classname') == 'URL'
                      ? ` <input id="slide_content${$sqCount}" onchange="onAddingURL(this)" type="text" class="form-control" name="slide_content${$sqCount}" data-frame="video${$sqCount}" required>`
                      : `<input id="slide_content${$sqCount}" onchange="readURL(this)" type="file" class="form-control-file" name="slide_content${$sqCount}" required>`
                    }

                </div>
            </div>
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              ${audioInput( $sqCount )}
            </div>
            <div class="col-12">
              <hr>
            </div>
            <div class="col-md-4">
                <div class="form-group pt-2 pb-5">
                    <label for="cool_down${$sqCount}">Slide Cool Down Time(in Seconds)</label>
                    <input name="cool_down${$sqCount}" id="cool_down${$sqCount}" class="form-control" type="number" value="60" min="0" required>
                </div>
            </div>
        </div>
        ${$saveBtn}
        `);
      $('#totalSlides').val($sqCount);
      $sqCount++;
      $(e).toggle();
    }

    // On Adding a Video URL
    function onAddingURL(e) {
      if ($(e).val().includes('youtu')) {
        $iframeMarkup = getEmbedURL($(e).val());
        $(e).val($iframeMarkup);
        $('#' + $(e).attr('data-frame')).attr('src', $iframeMarkup);
        $(e).prev().toggle();
      } else if ($(e).val().includes('embed')) {
        $('#' + $(e).attr('data-frame')).attr('src', $(e).val())
        $(e).prev().toggle();
      } else {
        alert('Please use a youtube video url');
        $(e).val('');
      }

    }

    // Convert Youtube link to Embed code
    function getEmbedURL(url) {
      const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
      const match = url.match(regExp);

      return (match && match[2].length === 11) ?
        'https://www.youtube.com/embed/' + match[2] :
        null;
    }

    // Add new Q&A
    function addNewQa(e) {
      $sqCount--;
      $(e).after( /*html*/ `
        <div class="form-group">
            <label>Question:</label>
            <div class="input-group mb-3">
                <select name="${$(e).attr('data-name')}[]"  class="form-control ${$(e).attr('data-name')} qa-sel" onchange="verifyDuplicateQA(this)"  required>
                    <option value="">Select a question</option>
                    ${ $("#qaInputs").html() }
                </select>
                <a href="javascript:;" class="input-group-text" onclick="deleteQA(this)"><i class="fas fa-trash"></i></a>
            </div>
        </div>
        <a href="javascript:;" onclick="addNewQa(this)" data-classname="addNewSlide" data-name="${$(e).attr('data-name')}"class=" btn btn-primary my-3 "><i class="fas fa-plus"></i>  Add New Q&A</a>
      `);
      $(e).remove();
      $sqCount++;
    }

    // Image upload
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $(input).prev().children().attr('src', e.target.result);
          $(input).next().val('none');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Delete Slide
    function deleteSlide(e) {
      $confirm = confirm('Do you want to delete this slide?');

      if ($confirm) {
        let form = $(e).closest('form');
        $(e).parent().parent().find('*').not('input[name="_token"]').remove()
        form.submit().fadeOut(500, function() {
          $(this).remove();
        });
      }
    }


    // Remove audio
    function removeAudio(e) {
      let slideCount = $(e).data('slide-count')
      $("#slide_audio" + slideCount).val('');
      $("#slide_audio_old" + slideCount).val('');
      $(e).parent().find('audio').remove();
    }

    // Verify duplicate qa
    function verifyDuplicateQA(e) {
      let IDs = [];
      $(e).closest('form').find('.qa-sel').each(function() {
        if ($(this).val() && IDs.includes($(this).val())) {
          $(e).closest('form').find('.qa-sel').val('')
          toast({
            type: 'danger',
            header: 'Duplicate Q&A selected!',
          })
          return
        }
        IDs.push($(this).val())
      });
    }

    // Update slide content
    function updateSlideContent(event, form, callback) {
      event.preventDefault();
      if (form.reportValidity()) {
        $('#loading').show();
        let subBtn = form.querySelector('button[type="button"]')
        const formData = new FormData(form)
        const url = form.action
        const method = form.method
        const headers = {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        const body = formData
        if (subBtn) {
         // btnLoadingToggle(subBtn, 'Saving')
        }
        let result = false;
        fetch(url, {
            method: method,
            headers: headers,
            body: body
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              if (subBtn) {
               // btnLoadingToggle(subBtn)
                changeBtnToSuccess(subBtn)
              }
              result = true;
              let message = data.message || 'Slide Updated Successfully!';
              // toast({
              //  type: 'success',
              //  header: message,
              //  timeout: 2000
             // })
              if (data.redirect) {
                window.location.href = data.redirect;
              }
              if (data.reload) {
                window.location.reload();
                return
              }
              $("#addNewSlideBtn").show()
            } else {
              if (subBtn) {
               // btnLoadingToggle(subBtn)
                changeBtnToError(subBtn)
              }
             // errorToast(data)
            }

            $('#loading').hide();
          })
          .catch(err => {
			console.log(err)
          //  errorToast(err)
            if (subBtn) {
            //  btnLoadingToggle(subBtn)
              changeBtnToError(subBtn)
            }
            $('#loading').hide();
          })

        return result
      }
    }

    function changeBtnToSuccess(subBtn) {
      $(subBtn).html(`<i class="fas fa-check"></i> Success`).data('action', 'edit').parent().css('height', '100%');
      setTimeout(() => {
        $(subBtn).html(`<i class="fas fa-edit"></i> EDIT`)
      }, 2000);
    }

    function changeBtnToError(subBtn) {
      $(subBtn).html(`<i class="fas fa-times"></i> ERROR`).removeClass('btn-success').addClass('btn-danger')
      setTimeout(() => {
        $(subBtn).html(`<i class="fas fa-undo-alt"></i> RETRY`).removeClass('btn-danger').addClass('btn-success')
      }, 2000);
    }

    function contentUpdateBtn(e) {
      if ($(e).data('action') == 'edit') {
        $(e).html(`<i class="fas fa-save"></i> UPDATE`).data('action', 'update').parent().css('height', '2rem');
      } else {
        $(e).closest('form').submit();
      }
    }
  </script>
@endsection
