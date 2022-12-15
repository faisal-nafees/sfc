@extends('classroom/layout')

@section('content')

  @php
  $slidePropgress = auth()
      ->user()
      ->slideprogress->where('slide_id', $slide->id)
      ->first();
  //Progress percentage
  @$progress = floor(($slidePropgress->progress / $slidePropgress->slide->total_slide) * 100);
  $s = @$slideContent->cool_down;
  $qaInputs = [];
  $next = $slideIndex + 1;
  $back = $slideIndex - 1;
  @endphp
   <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
      const data = JSON.parse('@json(@$data)');
    </script>
    <script type="text/babel" src="{{asset('js/chat_user.js')}}"></script>

    <div class="collapse position-absolute border-2" style="z-index: 1;right: 5%;top:0px;"  id="collapseExample">
       <div id="root"></div>
    </div>
<!-- Modal -->
	
  <div id="slide-wrapper" class="container  row ml-1  px-1">

    <!-- ----------------------------------------------------------------------- -->
    <!--                                  Error                                  -->
    <!-- ----------------------------------------------------------------------- -->
    @if (Session::has('error'))
      <div class="alert alert-danger col-12 p-3 mt-3">
        <ul>
          <li>{{ Session::get('error') }}</li>
        </ul>
      </div>
    @endif

    <!-- ----------------------------------------------------------------------- -->
    <!--                                  Slide                                  -->
    <!-- ----------------------------------------------------------------------- -->
    @if (Session::has('message'))
      @if ($slide->total_slide < $slideIndex + 1)
        <!--------------------------------------------------------------------------->
        <!--                             Lesson Complete                             -->
        <!-- ----------------------------------------------------------------------- -->
        <div id="slide-complete" class="col-12  d-flex align-items-center justify-content-center">
          <div>
            @foreach (auth()->user()->slideprogress as $slideprogress)
              @if ($slideprogress->slide_id == $slide->id)
                <!-- ------------------------ On Passing the lesson ------------------------ -->
                @if ($slideprogress->result == 'P')
                  <h1 class="text-success">{!! '<i class="fas fa-check"></i> Lesson Passed' !!}</h1>
                  <div class="col-12 navBtn px-0 py-2">
                    <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $back }}"
                      class="btn btn-primary back-btn" style="width: 150px">
                      <i class="fas fa-arrow-circle-left"></i> Back
                    </a>
                  </div>
                  <!-- ----------------------------------------------------------------------- -->

                  <!-- ------------------------ On failing the lesson ------------------------ -->
                @elseif($slideprogress->result == 'F')
                  <h1 class="text-danger">{!! '<i class="fas fa-times"></i> Lesson Failed' !!}</h1>
                  <form action="/restart_lesson" method="post">
                    @csrf
                    <input type="hidden" name="slide_progress_id" value="{{ $slideprogress->id }}">
                    <button submit="button" class="btn btn-secondary" style="width: 180px">
                      <i class=" fas fa-undo"></i> Restart Lesson
                    </button>
                  </form>
                @endif
                <!-- ----------------------------------------------------------------------- -->
              @endif
            @endforeach
          </div>
        </div>
        @php
          session()->forget('message');
        @endphp
      @endif
    @elseif($slideContent->image)
      <!-- ----------------------------------------------------------------------- -->
      <!--                               Image Slide                               -->
      <!-- ----------------------------------------------------------------------- -->
      <!-- -------------------------------- Image -------------------------------- -->
      <div id="slide-img" class="col-12 px-0 rounded">
        <img src="/storage/slideImages/{!! $slideContent->image !!}" alt="" class="fluid h-100 rounded text-center">
      </div>
      <!-- ----------------------------------------------------------------------- -->
      <!-- -------------------------------- Audio -------------------------------- -->
      <x-front.slide.audio :audio="$slideContent->audio" class="my-3" />
      <!-- ----------------------------------------------------------------------- -->

      <div class="col-12 navBtn px-0 py-2">
        <!-- ------------------------------- Buttons ------------------------------- -->
        <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $back }}"
          class="btn btn-primary back-btn ml-0  {{ $slideIndex == 1 ? 'd-none' : '' }}" style="width: 150px">
          <i class="fas fa-arrow-circle-left"></i> Back
        </a>

        @if ($slide->total_slide > $slideIndex)
          <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $next }}"
            class="btn btn-primary forward-btn ml-2
                    {{ $coolDown ? 'disabled' : '' }}"
            style="width: 150px">
            {!! $coolDown ? $slideContent->cool_down : 'Next <i class=" fas fa-arrow-circle-right"></i>' !!}
          </a>
          <div class="progress">
            <p class="text-success">{{ @$progress }}%</p>
          </div>
        @else
          @php
            $slideprogress = auth()
                ->user()
                ->slideprogress->where('slide_id', $slide->id)
                ->first();
          @endphp
          @if ($slideprogress->result == 'P')
            <h4 class="text-success  d-inline float-right"><i class="fas fa-check"></i> Lesson Passed</h4>
          @else
            <form action="/restart_lesson" class="d-inline-block ml-2" method="post">
              @csrf
              <input type="hidden" name="slide_progress_id" value="{{ $slideprogress->id }}">
              <button submit="button" class="btn btn-secondary" style="width: 150px">
                <i class=" fas fa-undo"></i> Restart
              </button>
            </form>
            <h4 class="text-danger  d-inline float-right"><i class="fas fa-times"></i> Lesson Failed</h4>
          @endif
        @endif
        <!-- ----------------------------------------------------------------------- -->

      </div>
      <!-- ----------------------------------------------------------------------- -->
    @elseif($slideContent->video)
      <!-- ----------------------------------------------------------------------- -->
      <!--                               Video Slide                               -->
      <!-- ----------------------------------------------------------------------- -->
      <!-- -------------------------------- Video -------------------------------- -->
      <div id="slide-vid" class="col-12 px-0 ">
        <iframe src="{{ $slideContent->video }}" class="text-center"></iframe>
      </div>
      <!-- ----------------------------------------------------------------------- -->

      <!-- -------------------------------- Audio -------------------------------- -->
      <x-front.slide.audio :audio="$slideContent->audio" class="my-3" />
      <!-- ----------------------------------------------------------------------- -->

      <div class="col-12 navBtn px-0 py-2">
        <!-- ------------------------------- Buttons ------------------------------- -->
        <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $back }}"
          class="btn btn-primary back-btn ml-0 {{ $slideIndex == 1 ? 'd-none' : '' }}" style="width: 150px">
          <i class="fas fa-arrow-circle-left"></i> Back
        </a>

        @if ($slide->total_slide > $slideIndex)
          <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $next }}"
            class="btn btn-primary forward-btn ml-2
                    {{ $coolDown ? 'disabled' : '' }}"
            style="width: 150px">
            {!! $coolDown ? $slideContent->cool_down : 'Next <i class=" fas fa-arrow-circle-right"></i>' !!}
          </a>
          <div class="progress">
            <p class="text-success">{{ @$progress }}%</p>
          </div>
        @else
          @php
            $slideprogress = auth()
                ->user()
                ->slideprogress->where('slide_id', $slide->id)
                ->first();
          @endphp
          @if ($slideprogress->result == 'P')
            <h4 class="text-success  d-inline float-right"><i class="fas fa-check"></i> Lesson Passed</h4>
          @else
            <form action="/restart_lesson" class="d-inline-block ml-2" method="post">
              @csrf
              <input type="hidden" name="slide_progress_id" value="{{ $slideprogress->id }}">
              <button submit="button" class="btn btn-secondary" style="width: 150px">
                <i class=" fas fa-undo"></i> Restart
              </button>
            </form>
            <h4 class="text-danger  d-inline float-right"><i class="fas fa-times"></i> Lesson Failed</h4>
          @endif
        @endif
        <!-- ----------------------------------------------------------------------- -->
      </div>
      <!-- ----------------------------------------------------------------------- -->
    @elseif($slideContent->qa_id)
      <div class="toast bg-danger" role="alert" aria-live="assertive" data-autohide="false" aria-atomic="true"
        style="position: fixed; top: 75px; right: 25px; z-index: 10">
        <div class="toast-header ">
          <strong class="mr-auto text-danger">Wrong Answer</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body alert-danger">
          Sorry, but you've answered some questions incorrectly.
        </div>
      </div>
      @php
        if ($slidePropgress->progress >= $slideIndex) {
            $qaDisabled = 'Disabled';
        }
        $answers = @session()->get('answers');
        // dd($answers[892][0]);
        $wrongAnswers = @session()->get('wrongAnswers');
        $noAnswers = @session()->get('noAnswers');

        // dd($wrongAnswers);

      @endphp
      <!-- ----------------------------------------------------------------------- -->
      <!--                                Q&A Slide                                -->
      <!-- ----------------------------------------------------------------------- -->

      <div id="slide-qa" class="col-12 px-0">
        <!-- --------------------------------- Q&A --------------------------------- -->
        <form action="/slide/qa/{{ $slideContent->id }}" method="post" id="qaForm">
          @csrf
          @if (@$qaDisabled)
            <h3 class="w-100 pt-3 pl-3">You have already answered the following.</h3>
          @else
            <h3 class="w-100 pt-3 pl-3">Answer the following to continue.</h3>
          @endif
          <div class="container pb-3">
            @foreach (explode(',', $slideContent->qa_id) as $qa_id)
              @foreach ($qas as $qa)
                @if ($qa_id == $qa->id)
                  <h5 class="mt-5"><strong>Q: {{ $qa->question }}</strong></h5>
                  @if (@$qa->image)
                    <div class="qa-img col-12 px-0 mb-4">
                      <img src="/storage/qa/{{ $qa->image }}" alt="" class="fluid w-100  text-center">
                    </div>
                  @endif

                  @php
                    $moreRightAnsLeft = false;
                  @endphp

                  @for ($i = 1; $i < 9; $i++)
                    @if ($qa['option' . $i] !== null)
                      @php
                        $checked = @$answers[$qa->id] && in_array('option' . $i, $answers[$qa->id]) ? 'checked' : null;
                        $rightAns = in_array('option' . $i, explode(',', $qa->answer)) ? true : false;
                        if (!$moreRightAnsLeft) {
                            $userAns = @auth()
                                  ->user()
                                  ->answers->where('qa_id', $qa->id)
                                  ->first();
                              $moreRightAnsLeft = @$userAns && @$userAns->answers != $qa->answer && $qa->multi_choice === 'Y' && !@$checked && $rightAns;
                          }
                          $qaInputs[] = $qa->id;
                        @endphp
                        <div class="form-check">
                          <input {{ @$checked }} {{ @$qaDisabled }}
                            class="{{ @$checked && !$rightAns ? 'is-invalid' : '' }}
                            form-check-input"
                            name="{{ $qa->id }}[]" id="option{{ $i . $qa->id }}"
                            type="{{ $qa->multi_choice !== 'Y' ? 'radio' : 'checkbox' }}"
                            value="option{{ $i }}" required>
                          <label class="form-check-label" for="option{{ $i . $qa->id }}">
                            {{ $qa['option' . $i] }}
                          </label><br>
                        </div>
                      @endif
                    @endfor

                    @if ($moreRightAnsLeft)
                      <p class="text-danger text-uppercase"><b>You didn't check all the right answers!</b></p>
                    @endif
                  @endif
                @endforeach
              @endforeach
            </div>
          </form>
          <!-- ----------------------------------------------------------------------- -->
        </div>


        <!-- -------------------------------- Audio -------------------------------- -->
        <div class="col-12">
          <x-front.slide.audio :audio="$slideContent->audio" class="my-3" />
        </div>
        <!-- ----------------------------------------------------------------------- -->


        <div class="col-12 navBtn px-0 py-2">
          <!-- ------------------------------- Buttons ------------------------------- -->
          <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $back }}"
            class="btn btn-primary back-btn ml-0 " style="width: 150px">
            <i class="fas fa-arrow-circle-left"></i> Back
          </a>
          @if (@$qaDisabled)
            @if ($slide->total_slide > $slideIndex)
              <a href="/slideShow/{{ $slide->category_id }}/{{ $slide->subcategory_id }}/{{ $slide->total_slide < $next ? $next - 1 : $next }}"
                class="btn btn-primary back-btn ml-0 " style="width: 150px">
                Next <i class="fas fa-arrow-circle-right"></i>
            @endif

            <div class="progress">
              <p class="text-success">{{ @$progress }}%</p>
            </div>
          @else
            <a href="#" onclick="$('#qaForm').submit()" class="btn btn-success back-btn" style="width: 150px">
              <i class="fas fa-check"></i> Submit
            </a>
          @endif
          <!-- ----------------------------------------------------------------------- -->
        </div>
      @endif
      <!-- ----------------------------------------------------------------------- -->


    </div>
    @if (!$slidePropgress->agreement)
      <!-- Modal -->
      <div class="modal fade " id="agreement-modal" tabindex="-1" aria-labelledby="agreement-modalLabel"
        aria-hidden="false" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <div class="overlay">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="agreement-modalLabel">Identity Verification</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-info">
                I '{{ auth()->user()->fname . ' ' . auth()->user()->lname }}' verify that myself and no one else is
                completing
                the '{{ $slide->subcategory->title }}' module.
              </p>
              <form action="/agreement" method="post" id="agreement-form">
                @csrf
                <input type="hidden" name="slide_id" value="{{ $slide->id }}">
                <div class="form-group">
                  <label for="name">Full Name</label>
                  <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                  <label for="date">Date</label>
                  <input type="date" class="form-control" name="date" id="date" required>
                </div>
                <button class="btn btn-primary spinner-btn" type="button" disabled style="display: none">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  <span class="sr-only">Submitting...</span>
                </button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    @endif

  @endsection

@section('script')
		    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
		   
		  
		  
  <script>
    @php
    if (!$slidePropgress->agreement) {
        echo "$('#agreement-modal').modal('show');";
    }
    @endphp

    $("#agreement-form").on("submit", function(event) {
      $('#agreement-modal').addClass('disabled');
    });


    $showPopUp = {{ @$wrongAnswers || @$noAnswers ? 1 : 0 }};
    if ($showPopUp) {
      $('.toast').toast('show')
    }

    $(document).ready(function() {
      $("img").on("contextmenu", function() {
        return false;
      });
    });
    $(window).on("load", function() {

      $('#submitBtn').click(function() {
        $('#qaForm').submit();
      });

      $seconds = {{ $coolDown ? $slideContent->cool_down : 0 }};
      $el = $('.forward-btn');

      $cancel = setInterval(incrementSeconds, 1000);

      function incrementSeconds() {
        $seconds -= 1;
        $el.text($seconds + "s");
        stopCounter();
      }

      function stopCounter() {
        if ($seconds <= 0) {
          clearInterval($cancel);
          $el.removeClass('disabled');
          $el.html(`Next <i class=" fas fa-arrow-circle-right">`);
        }
      }

      function submitQa(e) {
        if ($('input').is(':checked')) {
          $('#qaForm').submit();
        } else {
          alert('Please choose an answer');
        }
      }
    });
  </script>
		  
  @php
  if (session()->has('wrongAnswers')) {
      session()->forget('wrongAnswers');
  }
  if (session()->has('noAnswers')) {
      session()->forget('noAnswers');
  }
  @endphp
@endsection
