@extends('admin/layout')

@section('content')
  <li class="breadcrumb-item active" aria-current="page"><a href="/admin/slides/cat">Slides</a></li>
  <li class="breadcrumb-item active" aria-current="page">Add</li>
  </ol>
  </nav>
  <div class="row d-flex justify-content-center mt-5">

    @include('admin/inc/alert')

    <div class="col-md-10 card py-5 px-4 ">
      <form method="POST" action="/admin/slides/store" enctype="multipart/form-data" name="slideupdateform">
        @csrf

        <div class="row">
          {{-- Class --}}
          <div class="col-md-6">
            <div class="form-group">
              <label for="category_id">Class</label>
              <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                required>
                <option value="">Select a class</option>
                @foreach ($categories as $category)
                  <option @if (old('category_id') == $category->id) {{ 'selected' }} @endif value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
              </select>
              @error('category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          {{-- Lesson --}}
          <div class="col-md-6">
            <div class="form-group">
              <label for="subcategory_id">Lesson</label>
              <select name="subcategory_id" id="subcategory_id"
                class="form-control @error('subcategory_id') is-invalid @enderror" required>
                <option value="">First select a class</option>
              </select>
              @error('subcategory_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

        </div>
      </form>

      {{-- <!-- Button trigger modal -->
      <button id="floatingBtn" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalScrollable">
        Slide Order
      </button> --}}

      <div id="qaInputs" class=" d-none"> </div>
    </div>
  </div>


@endsection

@section('finalScript')
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js"></script>
  <script>
    /* -------------------------------------------------------------------------- */
    /*                              Slide Drag Drop                                */
    /* -------------------------------------------------------------------------- */
    var rowSize = 100; // => container height / number of items
    var container = document.querySelector(".Dcontainer");
    var listItems = Array.from(document.querySelectorAll(".Dlist-item")); // Array of elements
    var sortables = listItems.map(Sortable); // Array of sortables
    var total = sortables.length;

    TweenLite.to(container, 0.5, {
      autoAlpha: 1
    });

    function changeIndex(item, to) {

      // Change position in array
      arrayMove(sortables, item.index, to);

      // Change element's position in DOM. Not always necessary. Just showing how.
      if (to === total - 1) {
        container.appendChild(item.element);
      } else {
        var i = item.index > to ? to : to + 1;
        container.insertBefore(item.element, container.children[i]);
      }

      // Set index for each sortable
      sortables.forEach((sortable, index) => sortable.setIndex(index));
    }

    function Sortable(element, index) {

      var content = element.querySelector(".Ditem-content");
      var order = element.querySelector(".Dorder");

      var animation = TweenLite.to(content, 0.3, {
        boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
        force3D: true,
        scale: 1.1,
        paused: true
      });

      var dragger = new Draggable(element, {
        onDragStart: downAction,
        onRelease: upAction,
        onDrag: dragAction,
        cursor: "inherit",
        type: "y"
      });

      // Public properties and methods
      var sortable = {
        dragger: dragger,
        element: element,
        index: index,
        setIndex: setIndex
      };

      TweenLite.set(element, {
        y: index * rowSize
      });

      function setIndex(index) {

        sortable.index = index;
        order.textContent = index + 1;

        // Don't layout if you're dragging
        if (!dragger.isDragging) layout();
      }

      function downAction() {
        animation.play();
        this.update();
      }

      function dragAction() {

        // Calculate the current index based on element's position
        var index = clamp(Math.round(this.y / rowSize), 0, total - 1);

        if (index !== sortable.index) {
          changeIndex(sortable, index);
        }
      }

      function upAction() {
        animation.reverse();
        layout();
      }

      function layout() {
        TweenLite.to(element, 0.3, {
          y: sortable.index * rowSize
        });
      }

      return sortable;
    }

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
      array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
      return value < a ? a : (value > b ? b : value);
    }
    /* -------------------------------------------------------------------------- */
  </script>
  <script>
    /* -------------------------------------------------------------------------- */
    /*                             //Global Variables                             */
    /* -------------------------------------------------------------------------- */
    $sqCount = 1;
    $qas = "";
    $subcategories = @json($subcategories);

    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    /* -------------------------------------------------------------------------- */


    /* -------------------------- //On Category select -------------------------- */
    $('#category_id').change(function(e) {
      $oldVal = {{ old('subcategory_id', 0) }};

      $('#subcategory_id').html(``);
      $('#subcategory_id').append(`<option value="" >Select an option</option>`);
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
    /* -------------------------------------------------------------------------- */

    /* ------------------------- //On subcategory select ------------------------ */
    $('#subcategory_id').change(function(e) {
      $value = this.value;
      $.ajax({
        type: 'get',
        url: '/admin/slides/getqas',
        data: {
          'subcat_id': $value,
        },
        success: function(qas) {
          if ($('#active').length) {
            $('#qaInputs').html(qas);
            $('.qaSelect').html(`<option value="0">Select a question</option>
                    ` + $("#qaInputs").html());
            $('.qaSelect').val('');
          } else {
            $('#qaInputs').html(qas);
            $('#subcategory_id').parent().parent().after(`
                <div onClick="addNewSlide(this)" class="col-12 text-center mx-4">
                    <button type="button"  data-classname="addNewSlide" class=" btn btn-primary"><i class="fas fa-plus"></i> Add New Slide</button>
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-success mt-3">Submit</button>
                </div>

                `);
          }

          // $('#subcategory_id').parent().parent().nextAll('div').remove();


        }
      });
    })
    $x = 0;
    /* -------------------------------------------------------------------------- */

    /* ---------------------------- //Add a new slide --------------------------- */
    function addNewSlide(e) {
      if ($x >= 1) {
        if (document.slideupdateform.reportValidity()) {
          $(e).children('button').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      Saving progress`);
          $('form').append('<input type="hidden" name="addNewSlide" value="1">')
          $('form').submit();
        }
      } else {

        $(e).after(`
            <div class="col-md-12 " id="slide` + $sqCount + `" >
            <div class="addSlide">
                <div class="addSlideBtns p-3 d-flex justify-content-center align-content-center h-100 w-25 mx-auto row">
                    <button type="button" onClick="addSlideType(this)" data-classname="addImage" class="col-12 btn btn-primary my-3 "><i class="fas fa-image"></i> Add Image</button>
                    <h4 class="col-12 text-center text-muted">OR</h4>
                    <button type="button" onClick="addSlideType(this)" data-classname="addVideo" class="col-12 btn btn-primary my-3 "> <i class="fab fa-youtube"></i> Add Video</button>
                    <h4 class="col-12 text-center text-muted">OR</h4>
                    <button type="button" onClick="addSlideType(this)" data-classname="addQuesAns" class="col-12 btn btn-primary my-3 "><i class="fas fa-question"></i> Add Q&A</button>
                </div>
            </div>
            </div>
        `);
        $(e).remove();
      }
      $x++;
    }
    /* -------------------------------------------------------------------------- */

    /* --------------------------- //Select slide type -------------------------- */
    function addSlideType(e) {
      $(e).parent().toggle();
      //New Slide Button
      $(e).parent().parent()
        .after( /*html*/ `
        <div onClick="addNewSlide(this)" class="col-12 text-center ">
            <button type="button"  data-classname="addNewSlide" class=" btn btn-primary "><i class="fas fa-plus"></i> Add New Slide</button>
        </div>
        `);
      if ($(e).attr('data-classname') === "addImage") {
        //Add image
        $(e).parent().parent().html( /*html*/ `
            <p id="slideCounter${ $sqCount }">${ $sqCount }</p>
            <p id="deleteSlide${ $sqCount }"  class="deleteSlide" onclick="deleteSlide(this)">
                <a href="javascript:void(0)" ><i class="fas fa-times"></i></a>
            </p>
            <div class="addImage h-100 row mx-auto">
                <div class="col-md-12 py-5">
                    <div class="form-group">
                        <label for="slide_content${ $sqCount }">
                            Image
                        </label>
                            <div class="d-block p-b">
                                <img src="" class="fluid w-50 " alt="">
                            </div>
                        <input id="slide_content${ $sqCount }" onchange="readURL(this)" type="file" class="form-control-file"
                            name="slide_content${ $sqCount }"  accept="image/*" required>
                    </div>
                </div>
                <div class="col-md-12 pb-5">
                    <div class="form-group">
                        <label for="slide_audio${ $sqCount }">Audio</label>
                        <input id="slide_audio${ $sqCount }"  type="file" class="form-control-file"
                            name="slide_audio${ $sqCount }" accept="audio/mp3, audio/wav, audio/ogg" >
                            <span class="text-danger">Max file size: 8MB</span>
                        <br>
                    </div>
                </div>
                <div class="col-md-4 ml-0">
                    <div class="form-group pt-2 pb-5">
                        <label for="cool_down${ $sqCount }">Slide Cool Down Time(in Seconds)</label>
                        <input name="cool_down${ $sqCount }" id="cool_down${ $sqCount }" class="form-control" type="number" value="60" min="0" required>
                    </div>
                </div>
            </div>`);
        $(".Dcontainer").append( /*html*/ `
            <div class="Dlist-item">
                <div class="Ditem-content">
                <span class="Dorder" onchange="slideOC(this.text, ${ $sqCount })">${ $sqCount }</span> Image
                </div>
            </div>
        `)
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
            <p id="slideCounter` + $sqCount + `">` + $sqCount + `</p>
            <p id="deleteSlide` + $sqCount + `"  class="deleteSlide" onclick="deleteSlide(this)">
                <a href="javascript:void(0)" ><i class="fas fa-times"></i></a>            </p>
            <div class="addQuesAns col-md-12 py-5 ">
                <div class="form-group ">
                    <label for="slide_content` + $sqCount + `">Question:</label>
                    <div class="input-group mb-3">
                        <select name="slide_content` + $sqCount + `[]" id="slide_content` + $sqCount + `" class="form-control qaSelect" required>
                            <option value="">Select a question</option>
                            ` + $("#qaInputs").html() + `
                        </select>
                        <span class="input-group-text" onclick="deleteQA(this)"><i class="fas fa-trash"></i></span>
                    </div>
                </div>
                <button type="button" onclick="addNewQa(this)" data-classname="addNewSlide" class="mx-3 btn btn-primary my-3 "><i class="fas fa-plus"></i>  Add New Q&A</button>
            </div>
            <div class="form-group py-5 px-3">
                <label for="slide_audio${ $sqCount }">Audio</label>
                <input id="slide_audio${ $sqCount }"  type="file" class="form-control-file"
                    name="slide_audio${ $sqCount }" accept="audio/mp3, audio/wav, audio/ogg" >
            </div>
            <input name="cool_down` + $sqCount + `" id="cool_down` + $sqCount + `"  class="form-control" type="hidden" value="60" min="0" required>
        `);
        $sqCount++;
      }
    }
    /* -------------------------------------------------------------------------- */

    /* --------------------------- Slide Order Change --------------------------- */
    function slideOC(newI, oldI) {
      console.log(oldI, newI)
    }
    /* -------------------------------------------------------------------------- */

    /* ------------------------------- //Add Video ------------------------------ */
    function addVideo(e) {
      if ($(e).attr('data-classname') !== 'URL') {
        $(e).parent().parent().html( /*html*/ `
        <p id="slideCounter` + $sqCount + `">` + $sqCount + `</p>
        <p id="deleteSlide` + $sqCount + `"  class="deleteSlide" onclick="deleteSlide(this)">
            <a href="javascript:void(0)" ><i class="fas fa-times"></i></a>        </p>
        <div class="addVideo h-100 row mx-auto">
            <div class="col-md-12 py-5">
                <div class="form-group">
                    <label for="slide_content` + $sqCount + `">Video</label>
                    <div class="mb-3 iframe-container">
                        <iframe id="video` + $sqCount + `" src=""  ></iframe>
                    </div>
                    <input id="slide_content` + $sqCount + `" onchange="readURL(this)" type="file" class="form-control-file @error('slide_content`+$sqCount+`') is-invalid @enderror"
                        name="slide_content` + $sqCount + `" required>
                    @error('slide_content`+$sqCount+`')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
                <div class="col-md-12 pb-5">
                    <div class="form-group">
                        <label for="slide_audio${ $sqCount }">Audio</label>
                        <input id="slide_audio${ $sqCount }"  type="file" class="form-control-file"
                            name="slide_audio${ $sqCount }" accept="audio/mp3, audio/wav, audio/ogg" >
                    </div>
                </div>
            <div class="col-md-4 ml-0">
                <div class="form-group pt-2 pb-5">
                    <label for="cool_down` + $sqCount + `">Slide Cool Down Time(in Seconds)</label>
                    <input name="cool_down` + $sqCount + `" id="cool_down` + $sqCount + `" class="form-control" type="number" value="{{ old('slide_content`+$sqCount+`', 60) }}" min="0" required>
                </div>
            </div>
        </div>`);
        $sqCount++;
      } else {
        $(e).parent().parent().html( /*html*/ `
        <p id="slideCounter` + $sqCount + `">` + $sqCount + `</p>
        <p id="deleteSlide` + $sqCount + `" class="deleteSlide" onclick="deleteSlide(this)">
            <a href="javascript:void(0)" ><i class="fas fa-times"></i></a>
        </p>
        <div class="addVideo h-100 row mx-auto">
            <div class="col-md-12 py-5">
                <div class="form-group">
                    <label for="slide_content` + $sqCount + `">Video</label>
                    <div class="mb-3 iframe-container">
                        <iframe id="video` + $sqCount + `" src=""  ></iframe>
                    </div>
                    <input id="slide_content` + $sqCount + `" onchange="onAddingURL(this)" type="text" class="form-control @error('slide_content`+$sqCount+`') is-invalid @enderror"
                        name="slide_content` + $sqCount + `" data-frame="video` + $sqCount + `" required>
                    @error('slide_content`+$sqCount+`')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
                <div class="col-md-12 pb-5">
                    <div class="form-group">
                        <label for="slide_audio${ $sqCount }">Audio</label>
                        <input id="slide_audio${ $sqCount }"  type="file" class="form-control-file"
                            name="slide_audio${ $sqCount }" accept="audio/mp3, audio/wav, audio/ogg" >
                    </div>
                </div>
            <div class="col-md-4 ml-0">
                <div class="form-group pt-2 pb-5">
                    <label for="cool_down` + $sqCount + `">Slide Cool Down Time(in Seconds)</label>
                    <input name="cool_down` + $sqCount + `" id="cool_down` + $sqCount + `" class="form-control" type="number" value="{{ old('slide_content`+$sqCount+`', 60) }}" min="0" required>
                </div>
            </div>
        </div>`);
        $sqCount++;
      }
      $(e).toggle();
    }
    /* -------------------------------------------------------------------------- */

    /* ------------------------- //On Adding a Video URL ------------------------ */
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
    //Convert Youtube link to Embed code
    function getEmbedURL(url) {
      const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
      const match = url.match(regExp);

      return (match && match[2].length === 11) ?
        'https://www.youtube.com/embed/' + match[2] :
        null;
    }
    /* -------------------------------------------------------------------------- */

    /* ------------------------------ //Add new Q&A ----------------------------- */
    function addNewQa(e) {
      $sqCount--;
      $(e).after( /*html*/ `
        <div class="form-group px-3">
            <label for="slide_content` + $sqCount + `">Question:</label>
            <div class="input-group mb-3">
                <select name="slide_content` + $sqCount + `[]" id="slide_content` + $sqCount + `" class="form-control qaSelect" required>
                    <option value="0">Select a question</option>
                    ${$("#qaInputs").html()}
                </select>
                <span class="input-group-text" onclick="deleteQA(this)"><i class="fas fa-trash"></i></span>
            </div>
        </div>
        <button type="button" onclick="addNewQa(this)" data-classname="addNewSlide" class="mx-3 btn btn-primary my-3 ">Add New Q&A</button>

    `);
      $(e).remove();
      $sqCount++;
    }
    /* -------------------------------------------------------------------------- */

    /* ----------------------------- //Image upload ----------------------------- */
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $(input).prev().children().attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    /* -------------------------------------------------------------------------- */

    /* ----------------------------- //Delete Slide ----------------------------- */
    function deleteSlide(e) {
      $confirm = confirm('Do you want to delete this slide?');
      if ($confirm) {
        $dSI = parseInt($(e).parent().prev().text()); //Deleted Slide Index
        $nSI = $dSI + 1; //Next Slide Index
        if ($('#slide' + $nSI).length) { //If next slide Exist
          $newIndex = $dSI;
          for ($i = $nSI; $i < $sqCount; $i++) { //$i = oldIndex
            $('#slideCounter' + $i).html($newIndex);
            $('#slideCounter' + $i).attr('id', 'slideCounter' + $newIndex);
            $('#deleteSlide' + $i).attr('id', 'deleteSlide' + $newIndex);
            $('#slide_content' + $i).siblings('label').attr('for', 'slide_content' + $newIndex);
            if ($('.slide_content' + $i).is('select')) {
              $('.slide_content' + $i).attr('name', 'slide_content' + $newIndex + '[]');
              $('.slide_content' + $i).addClass('slide_content' + $newIndex);
              $('.slide_content' + $i).removeClass('slide_content' + $i);
            } else {
              $('#slide_content' + $i).attr('name', 'slide_content' + $newIndex);
              $('#slide_content' + $i).attr('id', 'slide_content' + $newIndex);
            }
            $('#slide_content' + $i).attr('id', 'slide_content' + $newIndex);
            if ($('#cool_down' + $i).siblings('label').length) {
              $('#cool_down' + $i).siblings('label').attr('for', 'cool_down' + $newIndex);
            }
            $('#cool_down' + $i).attr('name', 'cool_down' + $newIndex);
            $('#cool_down' + $i).attr('id', 'cool_down' + $newIndex);
            if ($('#slide_content' + $i).siblings('div').children('iframe').length) {
              $('#slide_content' + $i).siblings('div').children('iframe').attr('id', 'video' + $newIndex);
            }
            $('#slide' + $i).attr('id', '#slide' + $newIndex);
            // $('#slide'+$i).children()
            $newIndex++;
          }

        }
        $(e).parent().parent().fadeOut(500, function() {
          $(this).remove();
        }); //then delete slide
        $sqCount--; //sub sqcount by 1
      }
    }
    /* -------------------------------------------------------------------------- */

    /* ------------------------------ //Delete Q&A ------------------------------ */
    function deleteQA(e) {
      $(e).parent().parent().remove();
    }
    /* -------------------------------------------------------------------------- */
  </script>
@endsection
